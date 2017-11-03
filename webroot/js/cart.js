var buttons=document.getElementsByClassName('addToCart');

for(var i=0;i<buttons.length;i++) buttons[i].addEventListener('click',sendToCart);





function sendToCart(event) {
    event.preventDefault();
    var id=event.target.parentNode.dataset.id;
    // alert(id);
    var xhr=new XMLHttpRequest();
    xhr.open('POST','/addtocart',true);
    xhr.send(id);
    xhr.onreadystatechange=function () {
        if(this.readyState==4 && this.status==200){
            // alert(this.responseText);
        }
    }
}