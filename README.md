# requirejs

Requirements:

create a product list page with the 10products for each page and like that for 100 products and when we click on the specified product ,the product details of the specified product should be disaplyed.and add sorting like highest to lowest,lowest to highest.add range listing when the user clicking on specified range the products present in that range should be disaplayed.

solution:

productListPage.html,productListStyle.css,productListScript.js are the files of product display page.In productListPage.html consists of div block with topBanner which will disaply the heading and the two list for the operation of sorting and listing in range.productBlock which will display the content 10 div blocks for each page with the get of data from ProductList which is stored in an array.and down there is pagination block which will display 10 numbers and when we click on each on number the corresponding data will be dispalyed.for example when the user clicked on the 2nd number the function will take the number the user clicked and the multiply with the 10 and give it to the filteredProductList function which will be display the 10 blocks according to the user clicked in this case 21 to 30 products.when the user clicked on sorting the data will get sorted according to the button user clicked like high to low or low to high.when the user clicked on the list range the function will disaply the products between the range which take condtion and data which satified the data wwill be displayed. when user clicked on the product image,next page will be diverted where there the product details of user clicked will de dispalyed ,that when the user clicked the product details will get stored in local storage and in the next page the data is get retrived and displayed on the next page.

Duration:6hours testCases:all testcases are getting satisfying with the requirements needed. bugs :no bugs upto my knowledge
