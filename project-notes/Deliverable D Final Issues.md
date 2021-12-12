# Deliverable D Final Issues
#### Sports Warehouse Website
Index Page [[Index - Sports Warehouse Website]]
- - - -
## Shopping Final Issues at 17:25 Tuesday 21/11/2021
- [x] CHECKOUT: Javascript VALIDATION **REQUIRED**.
- [x] CHECKOUT: Confirmation page error. $OrderId is being lost. **REQUIRED**.

WAS `CHECKOUT FORM.PHP` -> `CONFIRMTION.HTML.PHP`

NOW `CHECKOUT FORM.PHP` -> `CONFIRMTION.PHP` -> `CONFIRMTION.HTML.PHP`

Solved: using $_GET in top of HTML layout file.

- [x] CHECKOUT: PHP VALIDATION **REQUIRED**.
- [ ] SHOPPING CART: CSS **REQUIRED**.
- [ ] CHECKOUT & CONTACT FORMS: Different background images required **REQUIRED**.
- [ ] CHECKOUT: Show item count in cart icon in menu bar.
- [ ] WHEN SHOPPING CART IS EMPTY: Show a “Your Shopping Cart is empty” message.
- [x] PRODUCT DISPLAY: set image size in HTML or CSS and remove from image name.
- [x] ADDING AN ITEM TO A CART: **Undefined variable $itemRow**. Item is added but the page then returns errors. **IN product-item.html.php**.
- [x] ITEM DISPLAY: Decimal float display using `sprintf(‘%1.2f’, $row[“price”]);` is inconsistent. ~IN  display-items.html.php~.

## Administration Final issues at 17:25 Monday 21/11/2021
- [x] UPDATING OR INSERTING ITEMS: Dropdown list to select an existing category **REQUIRED**.
- [ ] VALIDATION: PHP.
- [ ] VALIDATION: Javascript.
- [ ] UPDATING ITEMS: Will not allow update without uploading a photo. Is not checking on existing photo and allowing in update. ~IN ItemAdmin.php~.
- [ ] UPDATING ITEMS & CATEGORIES: working stand alone but not in the class ~IN ItemAdmin.php and CategoryAdmin.php~.
- [x] UPDATING ITEMS: query failedSQLSTATE[HY093]: Invalid parameter number: number of bound variables does not match number of tokens - **IN DBAccess.php function executeReadWrite**
- [x] CHANGING PASSWORD: query failedSQLSTATE[HY000]: General error: 1364 Field ‘Username’ doesn’t have a default value - **IN DBAccess.php function executeReadWrite**
- [x] UPLOADING A PHOTO: Undefined array key “photo” - Trying to access array offset on value of type null - **IN ItemAdmin.php function insertNewItem**

#### Sports Warehouse Website
Index Page [[Index - Sports Warehouse Website]]
- - - -
#sportsWarehouse