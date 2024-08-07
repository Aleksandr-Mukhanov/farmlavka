// class RegionsChooseDelivery {
//
//   constructor() {
//       this.loctionList = null;
//       this.onShowALLRegions();
//       console.log('--- start ---');
//   }
//
//   onSetRegion(regionId) {
//       BX.ajax.runAction('sotbit:regions.ChooseComponentController.setRegion', {
//           data: {regionId: regionId},
//       }).then(
//           (res) => res.data.actions.forEach(i => this[i](res.data)),
//           (err) => console.log(err),
//       )
//   }
//
//   onShowALLRegions() {
//
//       if (this.loctionList !== null) {
//           return this.SHOW_SELECT_REGIONS(this.loctionList);
//       }
//
//       BX.ajax.runAction('sotbit:regions.ChooseComponentController.showLocations', {})
//           .then(
//               (res) => res.data.actions.forEach(i => this[i](res.data)),
//               (err) => console.log(err),
//           )
//   }
//
//   SHOW_SELECT_REGIONS ({allRegions}) {
//
//       // this.onSelectRegionShow(true);
//
//       if (this.loctionList !== null) {
//           return;
//       }
//
//       const localRootElement = document.getElementById('deliveryCity');
//
//       this.loctionList = allRegions;
//
//       let counter = 0;
//
//       for (let i in allRegions) {
//           console.log(allRegions[i]);
//           const element = document.createElement('li');
//           element.setAttribute('class', 'city');
//           element.innerText = allRegions[i];
//           element.addEventListener('click', () => {
//               this.onSetRegion(i);
//               // this.onSelectRegionShow(false);
//           });
//           localRootElement.append(element);
//           counter++;
//           if (counter > 30) {
//               return;
//           }
//       }
//   }
// }
// console.log(321);
