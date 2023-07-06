require.config({
    baseUrl: 'node_modules/knockout/build/output',
    paths: {
      'knockout': 'knockout-latest',

    },
    
  });
  require(['knockout'], function(ko) {
    function OverlayViewModel() {
      var self = this;
      self.contentOpener = function(index) {
        console.log(index);
        var selectedProduct = self.productList()[index];
        localStorage.setItem('sampleData', JSON.stringify(selectedProduct));
        window.location.href = "secondPage.html";
    };
    

     
      self.optionPrice = ko.observableArray(["Choose Filter", "0.00$-0.25$", "0.25$-0.50$", "0.50$-0.75$", "0.75$-1.00$"]);
      self.selectedOptionValueOne = ko.observable("");
      self.something = ko.observableArray([]);
      self.productList = ko.observableArray([
        { id: 1, sku: "SKU001", quantity: 100, price: 0.13, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 2, sku: "SKU002", quantity: 52, price: 0.34, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 3, sku: "SKU003", quantity: 35, price: 0.43, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 4, sku: "SKU004", quantity: 80, price: 0.54, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 5, sku: "SKU005", quantity: 102, price: 0.12, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 6, sku: "SKU006", quantity: 92, price: 1.99, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 7, sku: "SKU007", quantity: 76, price: 0.43, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 8, sku: "SKU008", quantity: 65, price: 0.64, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 9, sku: "SKU0sasda08", quantity: 95, price: 0.23, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 10, sku: "SKU0sasda08", quantity: 45, price: 0.21, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 11, sku: "SKU001", quantity: 100, price: 0.13, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 12, sku: "SKU002", quantity: 52, price: 0.34, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 13, sku: "SKU003", quantity: 35, price: 0.43, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 14, sku: "SKU004", quantity: 80, price: 0.54, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 15, sku: "SKU005", quantity: 102, price: 0.12, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 16, sku: "SKU006", quantity: 92, price: 1.99, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 17, sku: "SKU007", quantity: 76, price: 0.43, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 18, sku: "SKU008", quantity: 65, price: 0.64, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 19, sku: "SKU0sasda08", quantity: 95, price: 0.23, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 20, sku: "SKU0sasda08", quantity: 45, price: 0.21, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 21, sku: "SKU001", quantity: 100, price: 0.13, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 22, sku: "SKU002", quantity: 52, price: 0.34, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 23, sku: "SKU003", quantity: 35, price: 0.43, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 24, sku: "SKU004", quantity: 80, price: 0.54, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 25, sku: "SKU005", quantity: 102, price: 0.12, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 26, sku: "SKU006", quantity: 92, price: 1.99, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 27, sku: "SKU007", quantity: 76, price: 0.43, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 28, sku: "SKU008", quantity: 65, price: 0.64, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 29, sku: "SKU0sasda08", quantity: 95, price: 0.23, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 30, sku: "SKU0sasda08", quantity: 45, price: 0.21, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 31, sku: "SKU001", quantity: 100, price: 0.13, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 32, sku: "SKU002", quantity: 52, price: 0.34, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 33, sku: "SKU003", quantity: 35, price: 0.43, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 34, sku: "SKU004", quantity: 80, price: 0.54, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 35, sku: "SKU005", quantity: 102, price: 0.12, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 36, sku: "SKU006", quantity: 92, price: 1.99, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 37, sku: "SKU007", quantity: 76, price: 0.43, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 38, sku: "SKU008", quantity: 65, price: 0.64, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 39, sku: "SKU0sasda08", quantity: 95, price: 0.23, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" },
        { id: 40, sku: "SKU0sasda08", quantity: 45, price: 0.21, image: "/home/z0407@ad.ziffity.com/Downloads/FUimg5.png" }
      ]);

      self.something(self.productList())
      self.optionSort = ko.observableArray(["Select Sort", "Price High-Low", "Price Low-High"]);
      self.selectedOptionValueTwo = ko.observable("");
      self.booleanValue = ko.observable(true);
    self.feetValue=ko.observable(1000)
    self.feetIncrease=function()
    {
        self.feetValue(self.feetValue() + 1000);
    }
self.feetDecrease=function()
{
    console.log(self.feetValue())
    if(self.feetValue()>1000)
    {
        self.feetValue(self.feetValue() - 1000);
    }
    else{
        alert("you cannot press less than 1000")
    }
   
}
      
      self.selectedOptionValueTwo.subscribe(function(newValue) {

        if(newValue=="Select Sort")
        {
            self.something(self.productList())
        }
        if (newValue === "Price Low-High") {
          self.something.sort(function(a, b) {
            return a.price - b.price;
          });
        }
        if (newValue === "Price High-Low") {
    self.something.sort(function(a, b) {
      return b.price - a.price;
    });
  }
  self.selectedOptionValueOne.subscribe(function(newValue)
  {

    console.log(newValue)
    if(newValue=="Choose Filter")
    {
        self.something(self.productList())
    }
    if (newValue === "0.00$-0.25$") {
        var newdata = self.productList().filter(function(el) {
            
          return(el.price >= 0.00 && el.price <= 0.25);
        });

        console.log(newdata)
        self.something(newdata);
      }
      if (newValue === "0.25$-0.50$") {
        console.log('hello')
        var newdata = self.productList().filter(function(el) {
          return el.price >= 0.25 && el.price <= 0.50;
        });
        console.log(newdata)
        self.something(newdata);
      }
      if (newValue === "0.50$-0.75$") {
        var newdata = self.productList().filter(function(el) {
          return el.price >= 0.50 && el.price <= 0.75;
        });

        console.log(newdata)
        self.something(newdata);
      }
      if (newValue === "0.75$-1.00$") {
        var newdata = self.productList().filter(function(el) {
          return el.price >= 0.75 && el.price <= 2.00;
        });

        console.log(newdata)
        self.something(newdata);
      }
    
  })
      });  
       var countProvider = ko.observable(10);
      self.numbers=ko.observableArray([1,2,3,4,5,6,7,8,9,10])
      self.selectedNumber = ko.observable(null);
      self.performNumbers = function(data) {
        console.log(data)
        self.selectedNumber(data);
        countProvider(10*data);
      };
      self.filteredProductList = ko.computed(function() {
        var duplicatearray=ko.observableArray()
        duplicatearray=self.something()
        return duplicatearray.slice(countProvider()-10, countProvider());
      });
 
    }

    var viewModel = new OverlayViewModel();
    ko.applyBindings(viewModel);
});