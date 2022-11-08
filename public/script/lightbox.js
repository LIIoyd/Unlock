class lightbox{

    static init(){
        const links = document.querySelectorAll('img[src$=".png"],img[src$=".jpg"],img[src$=".jpeg"]')
                .forEach(link => link.addEventListener('click', e=>{
                e.preventDefault();
                new lightbox(e.currentTarget.getAttribute('src'));
            })) 
    }

    constructor(url){
        const element = this.buildDom(url);
        document.body.appendChild(element);
    }

    close(e){
        e.preventDefault();
        const body = document.getElementsByTagName('body')[0];
        body.removeChild(document.getElementById('lightbox'));
    }

    buildDom(url) {
        const dom = document.createElement('div');
        dom.setAttribute('id','lightbox');
        dom.innerHTML = `<button class="lightbox_close">X</button>
        <div class="lightbox_container">
            <img src="${url}" alt="">
        </div>`;
        dom.querySelector('.lightbox_close').addEventListener('click',
        this.close.bind(this))
        return dom;
    }
}

lightbox.init();
