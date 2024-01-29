//console.log('script loaded');
//NOT WORKING!!! I WANT TO PREVENT PAGE FROM SCROLLING UP WHEN A STAR IS SELECTED!!!

//DOMContentLoaded executes function after gymIndividual page is loaded
// document.querySelectorAll('.rate input')selects input that are descendates of rate class
//forEach(function(star) iterates over each selected input

document.addEventListener('DOMContentLoaded', function(){
    
    document.querySelectorAll('.rate input').forEach(function(star){
        star.addEventListener('click', function(event){
            event.preventDefault(); //supposed to prevent page from scrolling up but it does not work
         
        });
    });

});
