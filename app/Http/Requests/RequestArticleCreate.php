<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestArticleCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'smi_name' => 'required',
            'smi_author' => 'required',
            'smi_original' => 'required',
            'smi_date' => 'required',
            'article_title' => 'required',
            'article_lead' => 'required',
            'article_text' => 'required',
            'article_cover' => 'required|image|mimes:jpg,bmp,png,svg|max:10000', 
        ];
    }

    public function messages()
    {
        return [
            'smi_name.required' => 'Заполните, пожалуйста, поле «Название СМИ».',
            'smi_author.required' => 'Укажите, пожалуйста, имя автора.',
            'smi_original.required' => 'Введите, пожалуйста, сылку на первоисточник. Скопируйте url-адрес материала на сайте СМИ.',
            'smi_date.required' => 'Введите, пожалуйста, дату публикации.',
            'article_title.required' => 'Озаглавьте, пожалуйста, материал.',
            'article_lead.required' => 'В тексте нужен лид.',
            'article_text.required' => 'Поле «Текст» — обязательное поле.',
            'article_cover.required' => 'Добавьте, пожалуйста, к материалу обложку статьи.',
            'article_cover.max' => 'Размер загружаемого файла обложки не должен превышать 10 мегабайтов.',
            'article_cover.mimes' => 'Проблема с файлом обложки. Разрешенные типы файлов: jpg, bmp, png, svg.',
            'article_cover.image' => 'Обложка должна быть графическим файлом.'
            
        ];
    }
}
