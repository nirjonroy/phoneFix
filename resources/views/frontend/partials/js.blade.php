<script src="{{ asset('backend/js/iziToast.min.js') }}"></script>
  <script src="{{ asset('backend/js/modules-toastr.js') }}"></script>
  <script src="{{ asset('backend/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    
    <script>
        @if(Session::has('messege'))
        var type="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('messege') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('messege') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('messege') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('messege') }}");
                break;
        }
        @endif
    </script>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error('{{ $error }}');
            </script>
        @endforeach
    @endif



<script>
    (function($) {
    "use strict";
    $(document).ready(function () {
        tinymce.init({
            selector: '.summernote',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ]
        });

        $('#dataTable').DataTable();
        $('.select2').select2();
        $('.sub_cat_one').select2();
        $('.tags').tagify();

        $('.datetimepicker_mask').datetimepicker({
            format:'Y-m-d H:i',

        });
        $('.custom-icon-picker').iconpicker({
            templates: {
                popover: '<div class="iconpicker-popover popover"><div class="arrow"></div>' +
                    '<div class="popover-title"></div><div class="popover-content"></div></div>',
                footer: '<div class="popover-footer"></div>',
                buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button>' +
                    ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
                search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
                iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
                iconpickerItem: '<a role="button" href="javascript:;" class="iconpicker-item"><i></i></a>'
            }
        })
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-Infinity'
        });
        $('.clockpicker').clockpicker();

    });

    })(jQuery);
</script>


<script>
    Swal.fire({
        title: 'Appoinment Successfull',
        icon: 'success',
        customClass: {
          confirmButton: 'btn btn-success', // You can customize other classes as needed
        },
    }).then((result) => {
        // Handle the result if needed
    });
</script>

<script>
    function toggleContent(optionId, contentId) {
        // Obtener la opción y el contenido seleccionados
        var content = document.getElementById(contentId);
        var link = document.getElementById(optionId);

        //Validar que no se cierre al pasar el mouse otra vez en a partir de 763px de width
        if (window.innerWidth > 763) {
            if (link.classList.contains('active')) {
                return;
            }
        }

        // Si la opción ya está activa, cerrar todos los menús desplegables y quitar la clase prp__navbar-fixed
        if (link.classList.contains('active')) {
            removeAllDropdownsActive();
            document.querySelector('.prp__navbar--content').classList.remove('prp__navbar-fixed');
            return;
        }

        // Cerrar todos los menús desplegables y eliminar la clase "active" de todas las opciones
        removeAllDropdownsActive();

        // Mostrar el contenido seleccionado
        content.classList.add('active');
        lastSubMenuOpen = content.querySelector('.prp__modal--col-submenu');

        if (lastSubMenuOpen) {
            lastSubMenuOpen.classList.add('active');
        }

        // Agregar la clase "active" a la opción seleccionada
        link.classList.add('active');

        // Agregar o quitar la clase prp__navbar-fixed según corresponda
        var navbarContent = document.querySelector('.prp__navbar--content');
        if (document.querySelector('.prp__navbar--dropdowns-content.active')) {
            navbarContent.classList.add('prp__navbar-fixed');
        } else {
            navbarContent.classList.remove('prp__navbar-fixed');
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        setEventListeners(); // Set listeners initially when content is loaded
    });

    // Seleccionar evento mouseover si desktop o click si movil
    function setEventListeners() {
        const toggleLinks = document.querySelectorAll("[data-toggle='content']");
        for (let i = 0; i < toggleLinks.length; i++) {
            const toggleOptionId = toggleLinks[i].getAttribute('data-option-id');
            const toggleContentId = toggleLinks[i].getAttribute('data-content-id');
            let eventType = window.innerWidth > 763 ? "mouseover" : "click";

            // definir toggle
            toggleLinks[i].listenerFunction = function() {
                toggleContent(toggleOptionId, toggleContentId);
            };

            toggleLinks[i].addEventListener(eventType, toggleLinks[i].listenerFunction);
        }
    }

    // Remover los listener en caso de que haya cambiado el width
    function removeEventListeners() {
        const toggleLinks = document.querySelectorAll("[data-toggle='content']");
        for (let i = 0; i < toggleLinks.length; i++) {
            if (toggleLinks[i].listenerFunction) {
                toggleLinks[i].removeEventListener("click", toggleLinks[i].listenerFunction);
                toggleLinks[i].removeEventListener("mouseover", toggleLinks[i].listenerFunction);
                delete toggleLinks[i].listenerFunction; // Clean up
            }
        }
    }

    // Remover/agregar el listener en caso de que haya cambiado el width
    window.addEventListener('resize', function() {
        removeEventListeners(); // Remove the existing listeners
        setEventListeners(); // Add new listeners based on the new window size
    });
</script>
<script>
    // Obtener el elemento de la barra de navegación pegajosa
    const navbarCorporateNav = document.querySelector('.prp__navbar--sticky');

    // Verificar si existe el elemento navbarCorporateNav
    if (navbarCorporateNav) {
        // Detectar el evento de desplazamiento
        window.addEventListener('scroll', function() {
            // Obtener la posición actual del desplazamiento
            const scrollPosition = window.scrollY;

            // Verificar si la posición actual es mayor a 100px
            if (scrollPosition > 100) {
                // Agregar la clase .prp__navbar--corporate para mostrar la barra de navegación pegajosa
                navbarCorporateNav.classList.add('prp__navbar--corporate');
            } else {
                // Eliminar la clase .prp__navbar--corporate para ocultar la barra de navegación pegajosa
                navbarCorporateNav.classList.remove('prp__navbar--corporate');
            }
        });
    }
</script>
<script>
    let lastSubMenuOpen = null;
    const modalContentSticky = document.querySelector('.prp__modal-content--repairs');
    const menuItemsSticky = modalContentSticky.querySelectorAll('.prp__menu-list--item');
    const resultsListsSticky = modalContentSticky.querySelectorAll('.prp__menu-results--list');
    const colItemsSticky = modalContentSticky.querySelector('.prp__modal--col-links')

    function showResults(event) {
        // Oculta todos los resultados
        resultsListsSticky.forEach(function(list) {
            list.classList.remove('active')
        });
        if (menuItemsSticky) {
            menuItemsSticky.forEach(function(list) {
                list.classList.remove('active')
            });
        }
        // Muestra los resultados correspondientes al ítem seleccionado
        const targetId = event.currentTarget.id.replace('-opt', '');
        const targetIdComplete = event.currentTarget.id
        const targetList = modalContentSticky.querySelector(`#${targetId}-results`);
        const targetListOption = document.getElementById(targetIdComplete);
        targetListOption.classList.add('active');
        targetList.classList.add('active');
        colItemsSticky.classList.add('active')

    }

    // Agrega el evento click a todos los ítems del menú
    if (menuItemsSticky) {
        menuItemsSticky.forEach(function(item) {
            let eventType = "click"
            if (window.innerWidth >= 763) {
                eventType = "mouseover"
            }
            item.addEventListener(eventType, showResults);
        });
    }


    const modalContentSticky2 = document.querySelector('.prp__modal-content--education');
    const menuItemsSticky2 = modalContentSticky2.querySelectorAll('.prp__menu-list--item');
    const resultsListsSticky2 = modalContentSticky2.querySelectorAll('.prp__menu-results--list');
    const colItemsSticky2 = modalContentSticky2.querySelector('.prp__modal--col-links')

    function showResults2(event) {
        // Oculta todos los resultados
        resultsListsSticky2.forEach(function(list) {
            list.classList.remove('active')
        });
        if (menuItemsSticky2) {
            menuItemsSticky2.forEach(function(list) {
                list.classList.remove('active')
            });
        }
        // Muestra los resultados correspondientes al ítem seleccionado
        const targetId = event.currentTarget.id.replace('-opt', '');
        const targetIdComplete = event.currentTarget.id
        const targetList = modalContentSticky2.querySelector(`#${targetId}-results`);
        const targetListOption = document.getElementById(targetIdComplete);
        targetListOption.classList.add('active');
        targetList.classList.add('active');
        colItemsSticky2.classList.add('active')
    }

    // Agrega el evento click a todos los ítems del menú
    if (menuItemsSticky2) {
        menuItemsSticky2.forEach(function(item) {
            let eventType = "click"
            if (window.innerWidth >= 763) {
                eventType = "mouseover"
            }
            item.addEventListener(eventType, showResults2);
        });
    }

    const modalContentSticky3 = document.querySelector('.prp__modal-content--more');
    const menuItemsSticky3 = modalContentSticky3.querySelectorAll('.prp__menu-list--item');
    const resultsListsSticky3 = modalContentSticky3.querySelectorAll('.prp__menu-results--list');

    function showResults3(event) {
        // Oculta todos los resultados
        resultsListsSticky3.forEach(function(list) {
            list.classList.remove('active')
        });
        if (menuItemsSticky3) {
            menuItemsSticky3.forEach(function(list) {
                list.classList.remove('active')
            });
        }
        const colItemsSticky3 = modalContentSticky3.querySelector('.prp__modal--col-links')

        // Muestra los resultados correspondientes al ítem seleccionado
        const targetId = event.currentTarget.id.replace('-opt', '');
        const targetIdComplete = event.currentTarget.id
        if (targetId) {
            const targetList = modalContentSticky3.querySelector(`#${targetId}-results`);
            targetList.classList.add('active');
        }
        if (targetIdComplete) {
            const targetListOption = document.getElementById(targetIdComplete);
            targetListOption.classList.add('active');
        }
        colItemsSticky3.classList.add('active');
    }

    // Agrega el evento click a todos los ítems del menú
    if (menuItemsSticky3) {
        menuItemsSticky3.forEach(function(item) {
            let eventType = "click"
            if (window.innerWidth >= 763) {
                eventType = "mouseover"
            }
            item.addEventListener(eventType, showResults3);
        });
    }

    const menuColListSticky = document.querySelectorAll('.prp__modal--col-links')

    function closeSubMenu() {
        if (window.innerWidth <= 763) {
            lastSubMenuOpen.classList.remove('active')
        }

    }

    const subMenuItems = document.querySelectorAll('.prp__modal--col-submenu li');
    subMenuItems.forEach(function(item) {
        item.addEventListener('click', closeSubMenu);
    });

    function closeThirdMenu() {
        const colItemsSticky = document.querySelector('.prp__modal--col-links');
        colItemsSticky.classList.remove('active');
        lastSubMenuOpen.classList.add('active');
        menuColListSticky.forEach(function(item) {
            item.classList.remove('active')
        })

    }


    document.addEventListener("DOMContentLoaded", function() {
        const checkbox = document.getElementById("nav-check-sticky");
        const svgBurguer = document.getElementById("burguer-icon");
        const persistentBurguer = document.getElementById("persistent-burguer-icon");
        const svgCross = document.getElementById("cross-icon");
        const persistentCross = document.getElementById("persistent-cross-icon");

        checkbox.addEventListener("change", function() {
            if (this.checked) {
                svgBurguer.style.display = "none"
                svgCross.style.display = "flex"
                persistentBurguer.style.display = "none"
                persistentCross.style.display = "flex"
            } else {
                svgBurguer.style.display = "flex"
                svgCross.style.display = "none"
                persistentBurguer.style.display = "flex"
                persistentCross.style.display = "none"
            }
        });
    });

    document.addEventListener('click', function(event) {
        var dropdownContent = event.target.closest('.prp__navbar--dropdowns-content');
        if (dropdownContent && dropdownContent.classList.contains('prp__modal')) {
            removeAllDropdownsActive();
        }
    });

    function removeAllDropdownsActive() {
        // Ocultar todos los contenidos
        var contents = document.querySelectorAll('.prp__navbar--dropdowns-content');
        for (var i = 0; i < contents.length; i++) {
            contents[i].classList.remove('active');
        }

        // Quitar la clase "active" de todas las opciones
        var links = document.querySelectorAll('.link-item');
        for (var i = 0; i < links.length; i++) {
            links[i].classList.remove('active');
        }

        var navbarContent = document.querySelector('.prp__navbar--content');
        navbarContent.classList.remove('prp__navbar-fixed');
    }


    // Función para remover la clase 'active' de todos los elementos con la clase 'prp__modal--col-links'
    function removeActiveFromColLinks() {
        const colLinks = document.querySelectorAll('.prp__modal--col-links');
        colLinks.forEach(function(link) {
            return link.classList.remove('active')
        });
    }

    // Función para remover la clase 'active' del elemento con la clase 'prp__navbar--dropdowns-content prp__modal'
    function removeActiveFromNavbarDropdown() {
        const navbarDropdown = document.querySelector('.prp__navbar--dropdowns-content.prp__modal');
        if (navbarDropdown) {
            navbarDropdown.classList.remove('active');
        }
    }

    // Función para remover la clase 'active' de todos los elementos y cerrar el navbar dropdown
    function resetMobileMenu() {
        removeActiveFromColLinks();
        removeActiveFromNavbarDropdown();
        removeAllDropdownsActive()
    }

    // Agrega el evento 'resize' al objeto window
    window.addEventListener('resize', resetMobileMenu);
</script>
<script>
    const navbarContent = document.querySelector('.prp__navbar--content');
    const navCheckbox = document.getElementById("nav-check-sticky");

    // this part is to check the change in the class of navbarContent
    const observer = new MutationObserver(function(mutationsList) {
        // In here we check if the navbar is displaying the menu
        const isOpen = navbarContent.classList.contains('prp__navbar-fixed');

        // Finally we apply an hidden to stop the scrolling of the body, and when the menu is closed, the page become normal again.
        document.body.style.overflow = isOpen ? 'hidden' : 'auto';
    });

    // Here we check every change with the function we made before applied to navbarContent.
    observer.observe(navbarContent, {
        attributes: true,
        attributeFilter: ['class']
    });

    // this function is to check the first part of the menu in the mobile
    function toggleMobileScrollbar() {
        const windowWidth = window.innerWidth;

        // we check that the change is only made in mobile devices
        if (windowWidth < 763) {
            // we apply "hidden" if the menu is open to block the scrollbar. Otherwise, the scrollbar is the same as always.
            document.body.style.overflow = navCheckbox.checked ? "hidden" : "auto";
        }
    }

    navCheckbox.addEventListener("change", toggleMobileScrollbar);
    toggleMobileScrollbar()
</script>
<script>
    function setCurrentYear(elementsClass) {
        const elements = document.getElementsByClassName(elementsClass)
        for (const element of elements) {
            element.textContent = new Date().getFullYear().toString()
        }
    }

    window.addEventListener('load', function() {
        var cookiesElement = document.getElementById('teconsent');
        setCurrentYear("current-year")

        var cookieLink = cookiesElement.querySelector('a');

        if (cookieLink && cookieLink.textContent === 'Preferencias de cookies') {
            cookieLink.textContent = 'Cookies Preferences';
            cookieLink.setAttribute("aria-label", 'Cookies Preferences')
        }
    });
</script>
<div id="consent_blackbar"></div>
<script type="text/javascript" src="https://consent.trustarc.com/notice?domain=assurant-global.com&amp;c=teconsent&amp;js=nj&amp;noticeType=bb&amp;gtm=1&amp;text=true&amp;label=true&amp;irmc=irmlink"></script>
<script>
    var __dispatched__ = {}; //Map of previously dispatched preference levels
    /*
First step is to register with the CM API to receive callbacks when a preference update
occurs. You must wait for the CM API (PrivacyManagerAPI object) to exist on the page before
registering.
*/
    var __i__ =
        self.postMessage &&
        setInterval(function() {
            if (self.PrivacyManagerAPI && __i__) {
                var apiObject = {
                    PrivacyManagerAPI: {
                        action: "getConsentDecision",
                        timestamp: new Date().getTime(),
                        self: self.location.host,
                    },
                };
                self.top.postMessage(JSON.stringify(apiObject), "*");
                __i__ = clearInterval(__i__);
            }
        }, 50);

    self.addEventListener("message", function(e, d) {
        try {
            if (
                e.data &&
                (d = JSON.parse(e.data)) &&
                (d = d.PrivacyManagerAPI) &&
                d.capabilities &&
                d.action == "getConsentDecision"
            ) {
                var newDecision = self.PrivacyManagerAPI.callApi(
                    "getGDPRConsentDecision",
                    self.location.host
                ).consentDecision;

                newDecision &&
                    newDecision.forEach(function(label) {
                        if (!__dispatched__[label]) {
                            self.dataLayer &&
                                self.dataLayer.push({
                                    event: "GDPR Pref Allows " + label
                                });
                            __dispatched__[label] = 1;
                        }
                    });
                if (window["refreshCookiesPermissions"]) {
                    window["refreshCookiesPermissions"](newDecision);
                }
            }
        } catch (xx) {
            /** not a cm api message **/
        }
    });
</script>
<script defer>
    (function() {
        var s = document.createElement('script');
        var h = document.querySelector('head') || document.body;
        s.src = 'https://acsbapp.com/apps/app/dist/js/app.js';
        s.async = true;
        s.onload = function() {
            acsbJS.init({
                statementLink: '',
                footerHtml: '',
                hideMobile: true,
                hideTrigger: true,
                disableBgProcess: false,
                language: 'en',
                position: 'right',
                leadColor: '#2d2d3a',
                triggerColor: '#2d2d3a',
                triggerRadius: '50%',
                triggerPositionX: 'right',
                triggerPositionY: 'center',
                triggerIcon: 'people',
                triggerSize: 'medium',
                triggerOffsetX: 20,
                triggerOffsetY: 20,
                mobile: {
                    triggerSize: 'small',
                    triggerPositionX: 'right',
                    triggerPositionY: 'bottom',
                    triggerOffsetX: 10,
                    triggerOffsetY: 10,
                    triggerRadius: '50%'
                }
            });
        };
        h.appendChild(s);
    })();
</script>

<script>
    const tabs = document.querySelectorAll('.prp__repair-tab');

    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });
            tab.classList.add('active');

            const target = tab.dataset.target;
            const content = document.querySelector(target);

            document.querySelectorAll('.prp__repair-tab-content').forEach(function(content) {
                content.style.display = 'none';
            });

            content.style.display = 'flex';
        });
    });

    /*Ocultar todos los contenidos al inicio*/
    document.querySelectorAll('.prp__repair-tab-content').forEach(function(content) {
        content.style.display = 'none';
    });

    /*Establecer como activa la primera pestaña al inicio*/
    const initialTab = document.querySelector('[data-target="#tab1"]');
    initialTab.classList.add('active');

    const initialContent = document.querySelector('#tab1');
    initialContent.style.display = 'flex';



    /*Animate when user show the section*/
    document.addEventListener('scroll', function() {
        var section = document.querySelector('.animated');
        var sectionPos = section.getBoundingClientRect().top;
        var windowHeight = window.innerHeight;

        if (sectionPos < windowHeight / 1.2) {
            section.classList.add('animate__animated', 'animate__fadeInLeft');
        }
    });
</script>
<!--SWIPER SLIDER-->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js">
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Selecciona todos los elementos con la clase .swiper
        var swipers = [...document.querySelectorAll(".swiper")];

        // Itera sobre cada uno de los elementos
        swipers.forEach(function(swiper) {
            if (typeof Swiper !== "undefined") {

                // Inicializa el objeto Swiper para cada uno
                var mySwiper = new Swiper(swiper, {
                    slidesPerView: "auto",
                    spaceBetween: 13.5,
                    /*slidesPerGroup: 2,*/
                    loop: false,
                    loopFillGroupWithBlank: true,
                    cssMode: true,
                    pagination: {
                        el: swiper.querySelector(".swiper-pagination"),
                        clickable: true,
                        renderBullet: function(index, className) {
                            return "<span class=" + className + ' prp__pagination--rectangle"></span>';
                        },
                    },
                    a11y: {
                        slideRole: 'link'
                    }
                });

                mySwiper.slides.forEach(function(slide) {
                    const title = slide.title
                    if (title) {
                        slide.ariaLabel = title
                    }

                    if (slide.classList.contains('first-cover-mobile')) {
                        slide.role = "group"
                    }
                })
            }
        });
    })


    function setupAccordion() {
        const accordionHeaders = document.querySelectorAll('.prp__accordion-header');

        accordionHeaders.forEach(function(header) {
            header.addEventListener('click', function() {
                const accordionIcon = header.querySelector('.prp__accordion-icon');
                const accordionContent = header.nextElementSibling;
                const headersArray = Array.from(accordionHeaders)
                const activeHeaders = headersArray.filter(function(element) {
                    element.classList.contains('active')
                })
                const isActiveHeader = header.classList.contains("active")

                // Si el encabezado actual no está activo, cerrar todos los elementos de acordeón
                if (activeHeaders.length > 0) {
                    activeHeaders.forEach(function(h) {
                        if (h.classList.contains('active')) {
                            h.classList.remove('active');
                            const icon = h.querySelector('.prp__accordion-icon');
                            icon.classList.remove('rotate');
                            const content = h.nextElementSibling;
                            if (content.classList.contains('prp__accordion-content')) {
                                content.classList.remove('active');
                                content.style.maxHeight = 0;
                            }
                        }
                    });
                }

                if (!isActiveHeader) {
                    // Alternar la clase 'active' y 'rotate' en el encabezado actual
                    header.classList.toggle('active');
                    accordionIcon.classList.toggle('rotate');

                    // Alternar la clase 'active' y la altura máxima del contenido de acordeón
                    if (accordionContent.classList.contains('prp__accordion-content') && accordionContent.classList.contains('active')) {
                        accordionContent.classList.remove('active');
                        accordionContent.style.maxHeight = 0;
                    } else if (accordionContent.classList.contains('prp__accordion-content')) {
                        accordionContent.classList.add('active');
                        accordionContent.style.maxHeight = accordionContent.scrollHeight + "px";
                    }

                    setTimeout(function() {
                        if (!isScrolledIntoView(header)) {
                            header.scrollIntoView({
                                behavior: "instant",
                                block: "center",
                                inline: "nearest"
                            });
                        }
                    }, 350)

                    console.log(header)
                }



            });
        });
    }

    function isScrolledIntoView(el) {
        const rect = el.getBoundingClientRect();
        const elemTop = rect.top;
        const elemBottom = rect.bottom;

        return (elemTop >= 0) && (elemBottom <= window.innerHeight);
    }

    setupAccordion();


    // Load SRC img
    let infoImgDesktop = {
        'infoImg1Desktop': '/assets/img/deal-of-the-month/deal-banner.webp',
        'infoImg2Desktop': '/assets/img/home/info-02.webp',
        'infoImg3Desktop': '/assets/img/home/info-03.webp',
    };
    let infoImgMobile = {
        'infoImg1Mobile': '/assets/img/deal-of-the-month/phones-rectangle-mobile.webp',
        'infoImg2Mobile': '/assets/img/home/business-find-mobile.webp',
        'infoImg3Mobile': '/assets/img/home/your-device-rectangle-mobile.webp',
    };
    let infoImgTablet = {
        'infoImg1Tablet': '/assets/img/deal-of-the-month/deal-banner.webp',
        'infoImg2Tablet': '/assets/img/home/info-02.webp',
        'infoImg3Tablet': '/assets/img/home/info-03.webp',
    }

    function onLoadImages(objImages) {
        // console.log('onLoadImages(objImages)');
        let idKeys = Object.keys(objImages);
        for (let i = 0; i < idKeys.length; i++) {
            let img = document.getElementById(idKeys[i])
            if (img) img.src = objImages[idKeys[i]];
        }
    }

    onLoadImages(infoImgDesktop);
    onLoadImages(infoImgTablet);
    onLoadImages(infoImgMobile);
    // End Load SRC img

    function onSearchLocator(inputId) {
        const zipCode = document.getElementById(inputId).value
        console.log("onSearchLocator - zipCode:", zipCode);
        localStorage.setItem('zipCode', zipCode);
    }

    function goBack() {
        window.history.back();
    }

    function convertCSS(css, oldWidth, newWidth) {
        var oldRatio = oldWidth / 100;
        var newRatio = newWidth / 100;



        // Reemplaza los valores de píxeles en las propiedades de margen y relleno
        css = css.replace(/(margin|padding)(-(top|bottom|left|right))?:(\s*)(\d+)px/g, function(match, p1, p2, p3, p4, p5) {

            var prefix = p2 || "";
            return p1 + prefix + ":" + p4 + (parseInt(p5) / oldRatio * newRatio).toFixed(2) + "px";
        });

        css = css.replace(/font-size:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "font-size:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });

        css = css.replace(/line-height:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "line-height:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });

        // Reemplaza los valores de píxeles en la propiedad de border-radius
        css = css.replace(/border-radius:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "border-radius:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });

        css = css.replace(/height:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "height:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });
        css = css.replace(/width:(\s*)(\d+)px/g, function(match, p1, p2) {

            return "width:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });
        css = css.replace(/column-gap:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "column-gap:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });

        css = css.replace(/row-gap:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "row-gap:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });

        css = css.replace(/max-width:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "max-width:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });
        css = css.replace(/right:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "right:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });
        css = css.replace(/left:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "left:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });
        css = css.replace(/top:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "top:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });
        css = css.replace(/bottom:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "bottom:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });


        // Reemplaza los valores de píxeles en otras propiedades CSS que desees convertir
        // Agrega más expresiones regulares y reemplazos según sea necesario para otras propiedades
        css = css.replace(/otra-propiedad:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "otra-propiedad:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });

        css = css.replace(/border-width:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "border-width:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });

        css = css.replace(/letter-spacing:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "letter-spacing:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });

        css = css.replace(/letter-spacing:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "letter-spacing:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });

        css = css.replace(/text-indent:(\s*)(\d+)px/g, function(match, p1, p2) {
            return "text-indent:" + p1 + (parseInt(p2) / oldRatio * newRatio).toFixed(2) + "px";
        });

        css = css.replace(/box-shadow:(\s*)(.*)(\d+)px(\s*)(\d+)px(\s*)(\d+)px(\s*)(\d+)px/g, function(match, p1, p2, p3, p4, p5, p6, p7, p8, p9) {
            var hOffset = (parseInt(p5) / oldRatio * newRatio).toFixed(2) + "px";
            var vOffset = (parseInt(p7) / oldRatio * newRatio).toFixed(2) + "px";
            var blurRadius = (parseInt(p9) / oldRatio * newRatio).toFixed(2) + "px";
            return "box-shadow:" + p1 + p2 + hOffset + p6 + vOffset + p8 + blurRadius;
        });

        css = css.replace(/text-shadow:(\s*)(.*)(\d+)px(\s*)(\d+)px(\s*)(\d+)px/g, function(match, p1, p2, p3, p4, p5, p6, p7) {
            var hOffset = (parseInt(p5) / oldRatio * newRatio).toFixed(2) + "px";
            var vOffset = (parseInt(p7) / oldRatio * newRatio).toFixed(2) + "px";
            var blurRadius = (parseInt(p3) / oldRatio * newRatio).toFixed(2) + "px";
            return "text-shadow:" + p1 + p2 + hOffset + p6 + vOffset + p7 + blurRadius;
        });

        return css;
    }



    var css = `
    .prp__booking--low-price {
display: flex;
align-items: center;
column-gap: 15px;
width: 100%;
height: 79px;
flex-shrink: 0;
border-radius: 17.22px;
background: #F3F2F2;
margin-top: 16px;
justify-content: center;
}

.prp__booking-low-price--icon {
width: 154px;
height: 57.779px;
}

.prp__booking--low-price--content {
display: flex;
flex-direction: column;
align-items: flex-start;
}

.prp__booking--low-price--t {
font-family: Avenir;
font-size: 14px;
font-weight: 200;
line-height: 19px;
letter-spacing: 0em;
text-align: left;
color: #2D2D3B;

}

.prp__booking--low-price--s {
font-family: Avenir;
font-size: 12px;
font-weight: 200;
line-height: 16px;
letter-spacing: 0em;
text-align: center;
color: #2C3E50;

}

.prp__form--row-notice {
width: 100%;
}

.prp__form--row-label {
font-family: Avenir;
font-size: 12px;
font-weight: 200;
line-height: 16px;
letter-spacing: 0em;
text-align: center;
color: #2C3E50;
display: flex;
margin: 0 auto;
margin-top: 3px;
max-width: 427px;
}
`;

    function removeExtraDecimals(css) {
        return css.replace(/(\d+)\.(\d+\.)+\d+px/g, function(match, p1) {
            const num = parseFloat(match);
            return num.toFixed(1) + 'px';
        });
    }

    function removeFloat(css) {
        return css = css.replace(/\d+\.\d+/g, function(match) {
            return Math.floor(parseFloat(match));
        });
    }
    /*LIMIT*/
    var removeF = removeFloat(css)
    var newCSS = convertCSS(removeF, 1240, 760);


    const fixedCSS = removeExtraDecimals(newCSS);

    // console.log(fixedCSS);

    const principalLocatorSearch = document.getElementById('principal-locator-search')
    const samsungLocatorSearch = document.getElementById('samsung-locator-search')
    const appleLocatorSearch = document.getElementById('apple-locator-search')

    principalLocatorSearch.addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            if (principalLocatorSearch.value !== '') {
                principalLocatorSearch.parentElement.getElementsByClassName('prp__banner-postc-btn')[0].click()
            }
        }
    })

    samsungLocatorSearch.addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            if (samsungLocatorSearch.value !== '') {
                samsungLocatorSearch.parentElement.getElementsByClassName('prp__repair-postc-btn')[0].click()
            }
        }
    })

    appleLocatorSearch.addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            if (appleLocatorSearch.value !== '') {
                appleLocatorSearch.parentElement.getElementsByClassName('prp__repair-postc-btn')[0].click()
            }
        }
    })

    window['onPrincipalSearchLocator'] = function(route) {
        const zipCode = HtmlSanitizer.SanitizeHtml(principalLocatorSearch.value);
        // console.log(`onPrincipalSearchLocator - zipCode: ${zipCode}`);
        localStorage.setItem('zipCode', zipCode);
        onRedirectLocator(route);
    }

    window['onSamsungLocator'] = function(route) {
        const zipCode = HtmlSanitizer.SanitizeHtml(samsungLocatorSearch.value);
        // console.log(`onSamsungLocator - zipCode: ${zipCode}`);
        localStorage.setItem('zipCode', zipCode);
        onRedirectLocator(route);
    }

    window['onAppleLocator'] = function(route) {
        const zipCode = HtmlSanitizer.SanitizeHtml(appleLocatorSearch.value);
        // console.log(`onAppleLocator - zipCode: ${zipCode}`);
        localStorage.setItem('zipCode', zipCode);
        onRedirectLocator(route);
    }

    function onRedirectLocator(route) {
        window.location.href = route
    }
</script>
<script defer src="{{asset('frontend/assets/js/locations.js')}}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        initAutoLocation()
    });
</script>




<script>
        window.addEventListener("load", function () {
  // Select the preloader element
  var preloader = document.getElementById("preloader");
  // Set a timeout of 2 seconds
  setTimeout(function () {
    // Fade out the preloader
    preloader.style.opacity = 0;
    // Remove the preloader from the DOM after the transition ends
    preloader.addEventListener("transitionend", function () {
      preloader.remove();
    });
  }, 2000);
});
    </script>
@stack('js')
