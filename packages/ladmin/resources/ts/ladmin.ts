import "../scss/ladmin.scss";
import ScrollBooster from "scrollbooster";

const viewElms = document.querySelectorAll('.sb-x-view');

viewElms.forEach((e) => {
    const c = e.querySelector(".sb-content");
    if(c) {
        new ScrollBooster({
            viewport: e,
            content: c,
            scrollMode: 'transform',
            direction: 'horizontal'
        });
    }
})

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
