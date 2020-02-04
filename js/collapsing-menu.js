(function() {


var allContainers = document.getElementsByClassName("type1-menu");

var breaks = [];

for (var i = 0; i < allContainers.length; i++) {
    breaks[i] = [];
}

function updateList() {

    for (var i = 0; i < allContainers.length; i++) {

        console.log(breaks[i]);
        
        var parent = allContainers[i];
        var btn = parent.getElementsByTagName("button")[0];
        var vlinks = parent.getElementsByTagName("ul")[0];
        var hlinks = parent.getElementsByTagName("ul")[1];

        var availableSpace = btn ? parent.offsetWidth : parent.offsetWidth - btn.offsetWidth - 30;

        // console.log(vlinks.offsetWidth, availableSpace)

        if(vlinks.offsetWidth > availableSpace){
    
            breaks[i].push(vlinks.offsetWidth);
            var vlastLi = vlinks.lastElementChild.previousElementSibling;
            hlinks.insertBefore(vlastLi, hlinks.childNodes[0]);

            btn.style.display = "block";

        } else if(availableSpace > breaks[i][breaks[i].length-1]){
            console.log("exceeds");

            var hfirstLi = hlinks.firstChild;
            vlinks.insertBefore(hfirstLi, vlinks.lastElementChild);
            breaks[i].pop();

            if(breaks[i].length < 1){
                btn.style.display = "none";
            }
        }
        if(btn.innerHTML !== btn.getAttribute("data-text-swap")){
            // btn.innerHTML = "+" + breaks[i].length;
            //btn.innerHTML = "Meer"
            if(btn.hasAttribute("data-original")){
                btn.innerHTML = btn.getAttribute("data-original") // + '(' + breaks[i].length + ')';
            } else{
                // hier was je bezig om het aantal verborgen items te weergeven in de knop.
                // var countSpan = document.createElement('span');
                // countSpan.innerHTML =  '(' + breaks[i].length + ')';
                // console.log(countSpan)
                // btn.appendChild(countSpan);
            }
        } 

        if(vlinks.offsetWidth > availableSpace) {
            updateList();
        }
    }
}


window.addEventListener("resize", updateList);
updateList();

window.addEventListener("click", function(e){
    if(e.target.classList.contains("check-toggle")){
        // updateList();
        var itsHlist = e.target.parentNode.nextElementSibling;
        if(itsHlist.style.display === "none"){
            this.console.log("gotem");
            itsHlist.style.display = "inline-flex";

            e.target.dataset.original = e.target.innerHTML;
            console.log(e.target.dataset.original)
            e.target.innerHTML = e.target.getAttribute("data-text-swap");

        } else {
            itsHlist.style.display = "none";
            e.target.innerHTML = "+" + itsHlist.children.length;

        }
        updateList();
    }

})
})();
