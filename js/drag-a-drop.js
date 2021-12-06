'use strict';
/**
 // ||||||||||||||||||||||||||||||| \\
 //	Global Object $: Generic controls
 // ||||||||||||||||||||||||||||||| \\
 **/
(function(){
    // http://stackoverflow.com/questions/4083351/what-does-jquery-fn-mean
    var $1 = function( elem ){
        if (!(this instanceof $1)){
            return new $1(elem);
        }
        this.el = document.getElementById( elem );
    };
    window.$1 = $1;
    $1.prototype = {
        onChange : function( callback ){
            this.el.addEventListener('change', callback );
            return this;
        }
    };
})();

/**
 // ||||||||||||||||||||||||||||||| \\
 //	Drag and Drop code for Upload
 // ||||||||||||||||||||||||||||||| \\
 **/
var dragdrop = {
    init : function( elem ){
        elem.setAttribute('ondrop', 'dragdrop.drop(event)');
        elem.setAttribute('ondragover', 'dragdrop.drag(event)' );
    },
    drop : function(e){
        e.preventDefault();

        var files = e.dataTransfer.files;
        runUpload( files );
    },
    drag : function(e){
        e.preventDefault();
    }
};

/**
 // ||||||||||||||||||||||||||||||| \\
 //	Code to capture a file (image)
 //  and upload it to the browser
 // ||||||||||||||||||||||||||||||| \\
 **/

var filesArray = {};

let count = 0;
function runUpload( files ) {
    // http://stackoverflow.com/questions/12570834/how-to-preview-image-get-file-size-image-height-and-width-before-upload

    
for (let i =0; i<files.length; i++) {
    if( files[i].type === 'image/png'  ||
        files[i].type === 'image/jpg'  ||
        files[i].type === 'image/jpeg' ||
        files[i].type === 'image/gif'  ||
        files[i].type === 'image/bmp'  ){

        filesArray[count++]=files[i];
        let countCur = count;
        var reader = new FileReader();
        reader.readAsDataURL( files[i] );
        reader.onload = function( _file ){
            console.log('test')
            let src = _file.target.result;
            $1('imges').el.innerHTML+=`<li data-id-im = ${--countCur}>
                            <a id="deleteImage" data-id-im = ${countCur} href="#"></a>
                            <img src="${src}" alt="">
                        </li>`;


            
        } // END reader.onload()
        // count++;
    }
    else if(files[i].type === 'video/mp4'){
        filesArray[count++]=files[i];
        let countCur = count;
        var reader = new FileReader();
        reader.readAsDataURL( files[i] );
        reader.onload = function( _file ){
            console.log('video upload')
            let src = _file.target.result;
            $1('imges').el.innerHTML+=`
            <li data-id-im = ${--countCur}>
                <a id="deleteImage" data-id-im = ${countCur} href="#"></a>
                <video src='${src}' width='50px'></video>
            </li>`
    }
}
    // END test if file.type === image
    console.log('finish')
}

}

/**
 // ||||||||||||||||||||||||||||||| \\
 //	window.onload fun
 // ||||||||||||||||||||||||||||||| \\
 **/
window.onload = function(){
    if( window.FileReader ){
        // Connect the DIV surrounding the file upload to HTML5 drag and drop calls
        dragdrop.init( $1('userActions').el );
        //	Bind the input[type="file"] to the function runUpload()

        
        $1('fileUpload').onChange(function(){ runUpload( this.files ); });


    }else{
        // Report error message if FileReader is unavilable
        var p   = document.createElement( 'p' ),
            msg = document.createTextNode( 'Sorry, your browser does not support FileReader.' );
        p.className = 'error';
        p.appendChild( msg );
        $1('userActions').el.innerHTML = '';
        $1('userActions').el.appendChild( p );
    }
};