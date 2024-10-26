const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

function EventToggle(object){
    object.classList.toggle("active");
}
function EventAddActive(object){
    object.classList.add("active");
}
function EventRemoveActive(object){
    object.classList.remove("active");
}

function scrollToCenter(element , container) {
    if (element) {
        const containerRect = container.getBoundingClientRect();
        const elementRect = element.getBoundingClientRect();

        const offset = (elementRect.left + elementRect.right) / 2 - (containerRect.left + containerRect.right) / 2;
        container.scrollLeft += offset;
    }
}

function scrollMouseList(container){
    let isDragging = false, startX, scrollLeft;
    container.addEventListener('mousedown', e => {
        isDragging = true;
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
    });
    container.addEventListener('mouseleave', () => isDragging = false);
    container.addEventListener('mouseup', () => isDragging = false);
    
    container.addEventListener('mousemove', e => {
        if (!isDragging) return;
        container.scrollLeft = scrollLeft - (e.pageX - container.offsetLeft - startX);
    });
}

function viewPort(sections, items) {
    const windowHeight = window.innerHeight;
    window.addEventListener('scroll', function() {
        sections.forEach(function(section, index) {
            const rect = section.getBoundingClientRect();
            if (rect.top <= windowHeight*0.5 && rect.bottom > windowHeight*0.5) {
                items[index].classList.add('active');
            } else {
                items[index].classList.remove('active');
            }
        });
    });
}

// window.addEventListener('load', function() {
//     window.scrollTo({
//         top: 0,
//         behavior: 'smooth'
//     });
// });

let topMenu = 0;
const fileName = window.location.pathname.split('/').pop();
if (fileName === 'products.php' || fileName === 'product_select.php') {
    topMenu = 1;
}else if (fileName === 'brands.php') {
    topMenu = 2;
}else if (fileName === 'contact.php') {
    topMenu = 3;
}else if (fileName === 'about.php') {
    topMenu = 4;
}else if (fileName === 'profile.php') {
    topMenu = 5;
}else if (fileName === 'user_cart.php') {
    topMenu = 6;
}


const topMenuItems = $$('.topMenu');
topMenuItems.forEach(element => {
    window.addEventListener('load', function() {
        $('.topMenu.active')?.classList.remove('active');
        EventAddActive(topMenuItems[topMenu]);
    });
});
