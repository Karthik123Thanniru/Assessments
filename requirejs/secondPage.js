require.config({
    baseUrl: 'node_modules/knockout/build/output',
    paths: {
      'knockout': 'knockout-latest',
      
      
    },
    
  });
  require(['knockout'], function(ko) {
    function OverlayViewModel() {
    
        var storedData = JSON.parse(localStorage.getItem('sampleData'));
        console.log(storedData)
        this.image = storedData.image;
        this.Product = storedData.id;
        this.SKU = storedData.sku;
        this.price = storedData.price;
        this.quantity = storedData.quantity;
    

    }
      var viewModel = new OverlayViewModel();
      ko.applyBindings(viewModel);
  });