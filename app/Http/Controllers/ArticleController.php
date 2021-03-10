<?php



namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\RequestArticleCreate;
use App\Http\Requests\RequestArticleEdit;





use Intervention\Image\Facades\Image as Image;



class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(5)->withQueryString();
        return view('article.index', compact('articles'));
    }









    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestArticleCreate $request)
    {
        $article = new Article([
            'smi_name' => $request->get('smi_name'),
            'smi_author' => $request->get('smi_author'),
            'smi_original' => $request->get('smi_original'),
            'smi_date' => $request->get('smi_date'),
            'article_title' => $request->get('article_title'),
            'article_lead' => $request->get('article_lead'),
           
        ]);


        // тут начинается работа с slug
        $article['article_slug'] = "art-".time();

//**** */
        
        // Динамический id из базы для названий папок
        $dinamicFolder = $article['article_slug'];
        
        //динамиески создается папка для новой сстатьи
        Storage::disk('public')->makeDirectory("/img/$dinamicFolder");  
   

        // тут начинается работа с summernote
        $article['article_text'] = $request->get('article_text');

        $dom = new \DomDocument();
        @$dom->loadHtml(mb_convert_encoding($article['article_text'], 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        $images = $dom->getElementsByTagName('img');
   
       
        


        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');

            if(preg_match('/data:image/', $data)){
				
				// get the mimetype
				preg_match('/data:image\/(?<mime>.*?)\;/', $data, $groups);
				$mimetype = $groups['mime'];
				
				// Generating a random filename
                $filename = uniqid();
                //    $filepath = "/storage/img/$filename.$mimetype";
                   $filepath = "/storage/img/$dinamicFolder/$filename.$mimetype";
             
//  dd($postFolder);
				// @see http://image.intervention.io/api/
				$image = Image::make($data);
				  // resize if required
                  $image->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image->encode($mimetype, 100); 	// encode file to the specified mimetype
                $image->save(public_path($filepath));
 
				$new_src = asset($filepath);
				$img->removeAttribute('src');
				$img->setAttribute('src', $new_src);
			} // <!--endif
        }
        
        
        $article['article_text'] = html_entity_decode($dom->saveHTML());
        //Было $article['article_text'] = $dom->saveHTML();
        //В базу записывалась абракадабра, если был русский текст

        //Обложка
        if ($request->hasFile('article_cover')) {

            // cache the file
            $file = $request->file('article_cover');

            // generate a new filename. getClientOriginalExtension() for the file extension
            $filename = 'cover-' . time() . '.' . $file->getClientOriginalExtension();

            $coverBig = Image::make($file);

            $coverBig->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $coverBig->save($file);

            // save to storage/app/photos as the new $filename
            // $path = $file->storeAs("img/", $filename);
            $path = $file->storeAs("img/$dinamicFolder/", $filename);

            //db
            $article['article_cover'] = $path;
        }

        $article->save();

        return redirect('/articles')->with('success', 'Пост добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $article = Article::find($id);

        return view('article.show', compact('article'));
    }









    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('article.edit', compact('article'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(RequestArticleEdit $request, $id)
    {
        
        $article = Article::find($id);

        $article->smi_name = $request->get('smi_name');
        $article->smi_author = $request->get('smi_author');
        $article->smi_original = $request->get('smi_original');
        $article->smi_date = $request->get('smi_date');
        $article->article_title = $request->get('article_title');
        $article->article_lead = $request->get('article_lead');


      
  
        // тут начинается работа с summernote
        $article->article_text = $request->get('article_text');
       
        $dom = new \DomDocument();
        @$dom->loadHtml(mb_convert_encoding($article['article_text'], 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');
        
        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');
            
            if(preg_match('/data:image/', $data)){
				
				// get the mimetype
				preg_match('/data:image\/(?<mime>.*?)\;/', $data, $groups);
				$mimetype = $groups['mime'];
				
				// Generating a random filename
				$filename = uniqid();
				$filepath = "/storage/img/".$article['article_slug']."/$filename.$mimetype";
   
               

				// @see http://image.intervention.io/api/
				$image = Image::make($data);
				  // resize if required
                  $image->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image->encode($mimetype, 100); 	// encode file to the specified mimetype
                $image->save(public_path($filepath));
    

               

				$new_src = asset($filepath);
                $img->removeAttribute('src');
                
				$img->setAttribute('src', $new_src);
			} // <!--endif
        }
        
        $article['article_text'] = $dom->saveHTML();







        //   Обложка     

        if ($request->hasFile('article_cover')) {



            Storage::delete($article->article_cover);
            


            // cache the file
            $file = $request->file('article_cover');

            // generate a new filename. getClientOriginalExtension() for the file extension
            $filename = 'cover-' . time() . '.' . $file->getClientOriginalExtension();

            $coverBig = Image::make($file);

            $coverBig->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $coverBig->save($file);
            // save to storage/app/photos as the new $filename
            $path = $file->storeAs('img/'.$article['article_slug'], $filename);

            //db
            $article['article_cover'] = $path;
        }

        $article->save();
        return redirect('/articles')->with('success', 'Статья отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
       
        // Storage::deleteDirectory("/img/.$article->article_slug");  
        // Storage::deleteDirectory($article->article_slug);  
        Storage::disk('public')->deleteDirectory("/img/".$article['article_slug']);
        // Storage::delete($article->article_slug);
        return redirect('/articles')->with('success', 'Статья была удалена');
        
    }
    
}

