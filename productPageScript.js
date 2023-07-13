'use strict';
require.config({
    baseUrl: 'node_modules/knockout/build/output',
    paths: {
      'knockout': 'knockout-latest'
    },   
  });
require(['knockout'], function(ko) {
    function OverlayViewModel() {
        let storedData = JSON.parse(localStorage.getItem('sampleData'));
        console.log(storedData)
        this.image = storedData.image;
        this.Product = storedData.id;
        this.SKU = storedData.sku;
        this.price = storedData.price;
        this.quantity = storedData.quantity;
    }
      let viewModel = new OverlayViewModel();
      ko.applyBindings(viewModel);
  });