
$(function() {
    $("#article_text").summernote({
        lang:'ru-RU',
        dialogsInBody: true,
        height:600,
        placeholder:'Введите, пожалуйста, основной текст статьи',
        focus: true,
        styleTags: [
            'p',
                { title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote' },
                 'h4', 'h5', 'h6'
            ],

        toolbar:[
            ['style', ['style','bold', 'italic', 'underline', 'clear'], []],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview']],
        ],
        

       
        maximumImageFileSize: 5242880, // 5 MB
        callbacks:{
             onImageUploadError: function(){
             oversizeModalShow()
            },

            
        }
    });
});








let oversizeModalButton =  document.querySelector("#oversizeModalButton");
let oversizeModalWrapper =  document.querySelector("#oversizeModalWrapper");
let oversizeModal =  document.querySelector("#oversizeModal");

function oversizeModalShow(){
    
    oversizeModalWrapper.style.display = "flex";
    oversizeModal.style.display = "flex";
} 


oversizeModalButton.onclick = oversizeModalHide;
oversizeModalWrapper.onclick = oversizeModalHide;



function oversizeModalHide(){
    oversizeModalWrapper.style.display = "none";
    oversizeModal.style.display = "none";
} 










