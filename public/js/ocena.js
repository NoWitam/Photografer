let elements = new Array(5);
let kursor = false;

for(let i=0; i < 5; i++)
{
    elements[i] = document.getElementById("star"+(i+1));
}

for(let i=0; i < 5; i++)
{
    elements[i].addEventListener("mouseover", () => { ocena(i+1) });
    elements[i].addEventListener("mouseout", () => { ocenaOut() });
}

function ocena(numer)
{
    kursor = true;
 for(let i=0; i < numer; i++)
 {
     elements[i].src = "{{ asset('icons/full-star.png') }}";
 }
 for(let i = numer; i < 5; i++)
 {
     elements[i].src = "{{ asset('icons/empty-star.png') }}";     
 }
}

function ocenaOut()
{
    kursor = false;
     setTimeout( () => {
         if(!kursor)
         {
            for(let i=0; i < 5; i++)
            {
               elements[i].src = "{{ asset('icons/empty-star.png') }}";
            }
         }       
     },50);
}

let mycom = document.getElementById("area");
mycom.addEventListener('input', () => {
    if(mycom.value.length == mycom.rows*50 && mycom.value.length < 300)
    {
        mycom.rows++;
    }

});