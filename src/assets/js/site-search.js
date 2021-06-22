import $ from 'jquery';

class NBS_SiteSearch {

    constructor() {

        this.$searchForm = $('#site-search');

        if ( ! this.$searchForm.length) {

            return;
        }

        this.searchToggleInit();
    }

    searchToggleInit() {

        let $toggle = $('[data-search-toggle]');
        let that = this;

        $toggle.click(function (e) {

            e.preventDefault();

            that.onToggle($(this));
        });
    }

    onToggle($toggle) {

        this.$searchForm.toggleClass('show');
    }
}

new NBS_SiteSearch();