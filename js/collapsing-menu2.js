

const visibleMenu = document.querySelector('.visible-menu')
const hiddenMenu = document.querySelector('.hidden-menu')
const btn = visibleMenu.getElementsByTagName("button")[0];

const firstli = visibleMenu.firstElementChild;

window.addEventListener("resize", updateList);

function updateList() {
    var hiddenItems = hiddenMenu.getElementsByTagName('li')
    var lastLi = visibleMenu.lastElementChild.previousElementSibling;

    if(detectLastOrSecondtolastWrap()){
        console.log(lastLi, hiddenMenu.childNodes[0])

        hiddenMenu.insertBefore(lastLi, hiddenMenu.childNodes[0]);
        btn.style.display = "block";
    }

    if(hiddenItems.length > 0 && detectSpaceNewLi()){
        var hfirstLi = hiddenMenu.firstChild;
        visibleMenu.insertBefore(hfirstLi, visibleMenu.lastElementChild);
        console.log('ik ben hier ook')
    }

    if(hiddenItems.length < 1){
        btn.style.display = "none";
    }
}
updateList()

function dectectWrap(lastLi){

    if(lastLi.offsetTop > firstli.offsetTop){
        return true
    }
}

function detectLastOrSecondtolastWrap(){
    var lastChild = visibleMenu.lastElementChild;
    var secondtolastChild = visibleMenu.lastElementChild.previousElementSibling;

    console.log(lastChild.offsetTop, firstli.offsetTop )
    if(lastChild.offsetTop > firstli.offsetTop || secondtolastChild.offsetTop > firstli.offsetTop ){
        
        return true
    }
}

function placeButtonBack(){
    // the first time it needs to put 2 lis in hidden list to make room for btn

}


function detectSpaceNewLi(){
    var ListItemCount = visibleMenu.getElementsByTagName('li').length
    var neededWidth = ListItemCount*firstli.offsetWidth + firstli.offsetWidth

    if(visibleMenu.offsetWidth > neededWidth){
        return true
    }
}


