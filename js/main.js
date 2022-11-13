let container   = document.querySelector(".container");
let h1          = document.querySelectorAll("h1");

const popup     = document.querySelector(".popup");
const bottom    = document.querySelector(".bottom");
const overlay   = document.getElementById('overlay');

// initialize popup menu
function createaPopup(letter, object) {
    popup.classList.add("active");
    overlay.classList.add("active");

    bottom.previousElementSibling.innerText = letter;

    // initialize object section
    for (let i = 0; i < object ["front"].length; i++) {
        let main        = document.createElement( "main" );
        let section     = document.createElement( "section" );
        let front       = document.createElement( "h3" );
        let val         = null;

        object ["back"] [i].includes( "img/" ) 
            ? val = "img" 
            : val = "h3";

        let back        = document.createElement(val);
        
        front.innerText     = object["front"][i];
        back.src            = object["back"][i];
        back.alt            = "Image Not Found.";
        back.innerText      = object["back"][i];

        front.classList.add("face");
        front.classList.add("front");
        back.classList.add("face");
        back.classList.add("back");

        section.appendChild(front);
        section.appendChild(back);
        main.appendChild(section);
        
        bottom.appendChild(main);

        section.addEventListener( "click", () => {
            section.classList.toggle( "active" );
        });
    }
}

// fetch date from api
fetch("api.json")
.then((rs) => {
    return rs.json();
})
.then((rs) => {
    let lettersObject  = rs;
    let keys           = Object.keys(lettersObject);

    // load letters
    for (let i = 0; i < keys.length; i++)
        h1[i].innerHTML = keys[i]

    // add action on each item
    container.addEventListener("click", (e) => {
        if (e.target.classList.contains("item") || lettersObject[e.target.innerText]){
            createaPopup(
                e.target.innerText, 
                lettersObject[e.target.innerText]
            );
        }
    });
});

overlay.addEventListener('click', () => {
    if (popup == null) return;

    popup.classList.remove('active');
    overlay.classList.remove('active');

    bottom.innerHTML = "";
});


function left(e){
    window.location.href = "php/main.php";
}