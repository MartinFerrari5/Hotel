let boton = document.getElementById('icono');
let menu = document.querySelector('.menu');
let enlaces = document.getElementById('enlaces');
let contador = 0;

let login = document.querySelector('.login');
call()
function call(){
    error()
}

boton.addEventListener('click', function(){
    if(contador==0){
        enlaces.className = ('enlaces dos')
        contador=1;
    }else{
        enlaces.classList.remove('dos')
        enlaces.className = ('enlaces uno')
        contador=0;
    }
});

    menu.addEventListener('click',e=>{
       
        login.classList.toggle('disappear');
        
    })

function error(){
    let alertas=[];
    let errores=document.querySelectorAll('.error')
    let success=document.querySelectorAll('.success')
    alertas=[errores, success]
    console.log(alertas)
if(alertas){
    alertas.forEach(alerta => {
        alerta.forEach(alert=>{
            setTimeout(() => {
                alert.style.opacity='0' 
                alert.style.display='none'
         }, 2000);
        })
        
    });
}
}

