let ileHasTagow = 0;

const hashtags = document.getElementById('hashtags');

function nowyHashtag()
{
    console.log('funckja');
    if(ileHasTagow < 3)
    {
        ileHasTagow++;
        const hashtag = document.createElement("div");
        hashtag.classList.add("hashtag");
        const hash = document.createElement("a");
        hash.classList.add("hash");
        const nazwa = document.createElement("a");
        hashtags.appendChild(hashtag);
        hashtag.appendChild(hash);
        hash.innerHTML = "#";
        hashtag.appendChild(nazwa);
        nazwa.innerHTML = document.getElementById('hashtag').value;
        const input = document.createElement("input");
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', 'hashtag'+ileHasTagow);
        hashtags.appendChild(input);
        input.value = document.getElementById('hashtag').value;
        document.getElementById('hashtag').value = "";

        if(ileHasTagow == 3)
        {
            document.getElementById('hashtags_div').remove();
        }
    }
    
}

const button = document.getElementById('dodaj');

document.getElementById('file').addEventListener( 'change', function( e )
{
    button.innerHTML = document.getElementById('file').value.replace(/^.*[\\\/]/, '');
    button.style.borderColor = 'green';
    button.style.color = 'white';
});
