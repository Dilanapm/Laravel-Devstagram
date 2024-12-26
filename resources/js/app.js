// import './bootstrap';
import Dropzone from "dropzone";

Dropzone.autoDiscover = false // por default dropzone va a buscar un elemento que tenga la clase de dropzone pero nosotros queremos darle el comportamiento a que endpoint o ruta queremos mandar las peticiones o las imagenes en este caso

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles:1,
    uploadMultiple: false,
    // para que dropzone guarde la imagen cuando el usuario no suba con el formulario
    init:function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenpublicada ={}
            imagenpublicada.size = 1234;
            imagenpublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this,imagenpublicada);
            this.options.thumbnail.call(this,imagenpublicada, `/uploads/${imagenpublicada.name}`);
            imagenpublicada.previewElement.classList.add(
                "dz-succes",
                "dz-complete"
            );
        }
        }
})

dropzone.on("sending",function(file,xhr,formdata){
    console.log(formdata);
});

dropzone.on('success',function (file,response){
    // console.log(response);
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('error',function (file,message){
    console.log(message);
});

dropzone.on('removedfile',function (){
    // console.log('archivo eliminado');
    document.querySelector('[name="imagen"]').value = "";

});