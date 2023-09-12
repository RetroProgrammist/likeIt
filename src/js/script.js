document.addEventListener("DOMContentLoaded", function () {

    window.getDataByAjax = async function (action, data) {
        if (typeof action !== 'string' || typeof data !== 'object') {
            return;
        }

        let url = new URL('router.php', 'http://localhost:8080/');
        url.searchParams.set('action', action);

        let response = await fetch(url, {
            method: 'POST',
            body: data
        })

        if (response.ok) {
            return response.json();
        } else {
            console.error('error', response);
        }
    }

    window.setSort = function (value) {
        let url = new URL(window.location.href);
        url.searchParams.set('sort', value)
        history.pushState(null, null, url.href);
    }

    window.getSort = function () {
        let params = new URLSearchParams(window.location.search);
        return params.get('sort') ? params.get('sort') : 'DESC';
    }

    window.isAdmin = function () {
        let params = new URLSearchParams(window.location.search);
        return !!params.get('admin');
    }

    /* background */
    new BVAmbient({
        selector: "#ambient",
        fps: 60,
        max_transition_speed: 12000,
        min_transition_speed: 8000,
        particle_number: 30,
        particle_maxwidth: 60,
        particle_minwidth: 10,
        particle_radius: 50,
        particle_opacity: true,
        particle_colision_change: true,
        particle_background: "#cff4fc",
        particle_image: {
            image: false,
            src: ""
        },
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    particle_number: "15"
                }
            },
            {
                breakpoint: 480,
                settings: {
                    particle_number: "10"
                }
            }
        ]
    });
});


