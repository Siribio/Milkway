class MobileNavBar {
    constructor(mobile_menu, nav_list, nav_li){
        this.mobile_menu = document.querySelector(mobile_menu);
        this.nav_list = document.querySelector(nav_list);
        this.nav_li = document.querySelectorAll(nav_li);
        this.active_class = 'active';

        this.handle_click = this.handle_click.bind(this);
    }

    animate_links() {
        this.nav_li.forEach((link, index) => {
          link.style.animation
            ? (link.style.animation = "")
            : (link.style.animation = `navLinkFade 0.5s ease forwards ${
                index / 7 + 0.3
              }s`);
        });
      }
    

    handle_click(){
        this.nav_list.classList.toggle(this.active_class);
        this.mobile_menu.classList.toggle(this.active_class);
        this.animate_links();
    }

    add_click_event() {
        this.mobile_menu.addEventListener('click', this.handle_click);
    }

    init() {
        if(this.mobile_menu) this.add_click_event();
        return this;
    }
}

const mobile_navbar = new MobileNavBar(
    ".mobile_menu",
    ".list_nav", 
    ".list_nav li"
);

mobile_navbar.init();