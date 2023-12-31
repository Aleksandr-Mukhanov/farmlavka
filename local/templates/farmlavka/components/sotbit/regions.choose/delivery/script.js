class RegionsChooseDelivery {

    constructor() {

        this.getRegion();

        this.rootId = 'regions_choose_component_delivery';
        this.rootDropDownId = 'regions_choose_component_dropdown_delivery';
        this.selectRegionID = 'regon_choose_select-city__modal_delivery';
        // this.selectRegionOverlayID = 'regon_choose_modal__overlay';

        this.questionRegionId = null;
        this.loctionList = null;

        this.root = document.getElementById(this.rootId);
        this.rootDropDown = document.getElementById(this.rootDropDownId);
        this.selectRegion = document.getElementById(this.selectRegionID);
        // this.selectRegionOverlay = document.getElementById(this.selectRegionOverlayID);

        this.setEvents();
    }

    getEntity(parent, entity, all=false) {
        if (!parent || !entity) {
            return null;
        }
        if (all) {
            return parent.querySelectorAll('[data-entity="' + entity + '"]');
        }
        return parent.querySelector('[data-entity="' + entity + '"]');
    }

    setEvents() {
        const yesBtn = this.getEntity(this.rootDropDown, 'select-city__dropdown__choose__yes');
        const notBnt = this.getEntity(this.rootDropDown, 'select-city__dropdown__choose__no');
        // const cityName = this.getEntity(this.root, 'select-city__block__text-city');
        // const selectRegionClose = this.getEntity(this.selectRegion, 'select-city__close');
        const searchLine = this.getEntity(this.selectRegion, 'select-city__modal__submit__input');
        const selectRegionBtn = this.getEntity(this.selectRegion, 'select-city__modal__submit__btn');

        this.onShowALLRegions();

        yesBtn.addEventListener('click', () => this.onSetRegion(this.questionRegionId));
        notBnt.addEventListener('click', () => {
            this.onShowALLRegions();
            this.dropDownShow(false);
        });
        // cityName.addEventListener('click', () => this.onShowALLRegions());
        // selectRegionClose.addEventListener('click', () => this.onSelectRegionShow(false));
        searchLine.addEventListener('input', e => this.onInputSearch(e))

        selectRegionBtn.addEventListener('click', () => {
            const selectedRegion = Object.keys(this.loctionList)
                .filter(i => searchLine.value === this.loctionList[i]);

            if (selectedRegion.length === 0) {
                this.getEntity(this.selectRegion, select-city__modal__submit__block-wrap__input_wrap_error)
                    .setAttribute('style', '');
                return;
            }

            this.onSetRegion(selectedRegion[0]);
            this.onShowALLRegions(false);
        })

    }

    onSetRegion(regionId) {
        BX.ajax.runAction('sotbit:regions.ChooseComponentController.setRegion', {
            data: {regionId: regionId},
        }).then(
            (res) => res.data.actions.forEach(i => this[i](res.data)),
            (err) => console.log(err),
        )
    }

    dropDownShow(action) {
        if (action) {
            this.rootDropDown.setAttribute('style', 'display: block;');
        } else {
            this.rootDropDown.setAttribute('style', 'display: none;');
        }
    }

    onShowALLRegions() {

        if (this.loctionList !== null) {
            return this.SHOW_SELECT_REGIONS(this.loctionList);
        }

        BX.ajax.runAction('sotbit:regions.ChooseComponentController.showLocations', {})
            .then(
                (res) => res.data.actions.forEach(i => this[i](res.data)),
                (err) => console.log(err),
            )
    }

    getRegion() {

        const query = new URLSearchParams(window.location.search);

        this.removeRegionGetParams(query);

         BX.ajax.runAction('sotbit:regions.ChooseComponentController.getRegion', {
            data: {redirectRegionId: query.get('redirectRegionId')},
        })
        .then(
            (res) => res.data.actions.forEach(i => this[i](res.data)),
            (err) => console.log(err),
        )

    }

    onSelectRegionShow(action) {
        // if (action) {
        //     this.selectRegion.setAttribute('style', 'display: block;');
        //     // this.selectRegionOverlay.setAttribute('style', 'display: block;');
        // } else {
        //     // this.selectRegionOverlay.setAttribute('style', 'display: none;');
        //     this.selectRegion.setAttribute('style', 'display: none;');
        // }

        this.getEntity(this.selectRegion, 'select-city__modal__submit__block-wrap__input_wrap_error')
            .setAttribute('style', 'display: none;');
    }

    SHOW_REGION_NAME ({currentRegionName}) {
        const elment = this.getEntity(this.root, 'select-city__block__text-city');
        elment.innerText = currentRegionName;
        this.getEntity(this.selectRegion, 'select-city__js').innerText = currentRegionName;
    }

    SHOW_QUESTION ({currentRegionName, currentRegionId}) {
        this.questionRegionId = currentRegionId;
        this.dropDownShow(true);
        const element = this.getEntity(this.rootDropDown, 'select-city__dropdown__title');
        element.innerText = element.textContent.replace('###', currentRegionName).trim();
    }

    CONFIRM_DOMAIN ({currentRegionName}) {
        this.dropDownShow(false);
        const elemnt = this.getEntity(this.root, 'select-city__block__text-city');
        elemnt.innerText = currentRegionName;
        this.getEntity(this.selectRegion, 'select-city__js').innerText = currentRegionName;
    }

    SHOW_SELECT_REGIONS ({allRegions}) {

        this.onSelectRegionShow(true);

        if (this.loctionList !== null) {
            return;
        }

        const localRootElement = this.getEntity(this.selectRegion, 'select-city__modal__list');

        this.loctionList = allRegions;

        let counter = 0;

        for (let i in allRegions) {
            const element = document.createElement('p');
            element.setAttribute('data-entity', 'select-city__modal__list__item');
            element.setAttribute('class', 'select-city__modal__list__item');
            element.innerText = allRegions[i];
            element.addEventListener('click', () => {
                this.onSetRegion(i);
                this.onSelectRegionShow(false);
            });
            localRootElement.append(element);
            counter++;
            if (counter > 14) {
                return;
            }
        }
    }

    REDIRECT_TO_SUBDOMAIN ({currentRegionCode, currentRegionId}) {
        const hostName = window.location.hostname;
        const protocol = window.location.protocol;
        const newUrl = window.location.href.replace(hostName, currentRegionCode);
        const url = new URL(newUrl, `${protocol}${currentRegionCode}`);
        url.searchParams.set('redirectRegionId', currentRegionId);
        window.location.href = url.toString();
    }

    CONFIRM_CITY ({}) {
    }

    onInputSearch(e) {

        const elementClass = 'regions_vars';
        this.getEntity(this.selectRegion, elementClass, true).forEach(i => i.remove());
        const text = e.currentTarget.value;
        const localRootElement = this.getEntity(this.selectRegion, 'select-city__modal__submit__vars');
        this.getEntity(this.selectRegion, 'select-city__modal__submit__block-wrap__input_wrap_error')
            .setAttribute('style', 'display: none;');

        if (text.length  < 2) {
            localRootElement.setAttribute('style', 'display: none;');
            return;
        }

        const currentTarget = e.currentTarget;

        const match = Object.keys(this.loctionList).filter(i => {
            return  new RegExp(text, 'i').test(this.loctionList[i])
        });

        if (match.length > 0) {
            localRootElement.setAttribute('style', 'display: block;');
        } else {
            localRootElement.setAttribute('style', 'display: none;');
        }

        match.forEach(i => {
            const element = document.createElement('div');
            element.setAttribute('data-entity', elementClass);
            element.setAttribute('class', elementClass);
            element.setAttribute('tabindex', 0);
            element.innerText = this.loctionList[i];
            element.addEventListener('click', () => {
                currentTarget.value = this.loctionList[i];
                this.getEntity(this.selectRegion, elementClass, true).forEach(i => i.remove());
                localRootElement.setAttribute('style', 'display: none;');
            });
            localRootElement.append(element);
        })
    }

    removeRegionGetParams(query) {
        if (query.has('redirectRegionId')) {
            const url = new URL(window.location.href, window.location.href);
            url.searchParams.delete('redirectRegionId');
            window.history.replaceState(null, '', url)
        }
    }
}
