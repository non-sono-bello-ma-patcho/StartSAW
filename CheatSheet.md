# StartSAW

functions that require "userUtility.php"

getUserName() : on success returns the name of the user "cookies['user']" (so the user must be online). 
On error the function redirects on "error.php" with $session['last_error'] set.

getUserSurname() : on success returns the surname of the user "cookies['user']" (so the user must be online). 
On error the function redirects on "error.php" with $session['last_error'] set.

getUserMail() : on success returns the mail of the user "cookies['user']" (so the user must be online). 
On error the function redirects on "error.php" with $session['last_error'] set.

getUserPswd() : on success returns the password of the user "cookies['user']" (so the user must be online). 
On error the function redirects on "error.php" with $session['last_error'] set.

getUserImg() : on success returns the html string representing the img of the user "cookies['user']" (so the user must be online) in this format: 
"<img width = "100" height="100" src='img_path'>".
On error the function redirects on "error.php" with $session['last_error'] set.

setUserName($newName) : the function changes the name stored in the database of the user "cookies['user']" 
with $newName (so the user must be online) and returns true.
on error the function redirects on "error.php" with $session['last_error'] set.

setUserSurname($newSurname) : the function changes the surname stored in the database of the user  "cookies['user']" 
with $newSurname (so the user must be online) and returns true.
on error the function redirects on "error.php" with $session['last_error'] sett.

setUserMail($newMail) : the function changes the mail stored in the database of the user "cookies['user']" 
with $newMail (so the user must be online) and returns true.
on error the function redirects on "error.php" with $session['last_error'] set.

setUserPswd($newPswd) : the function changes the password stored in the database of the user "cookies['user']" 
with $newPswd (so the user must be online) and returns true.
on error the function redirects on "error.php" with $session['last_error'] set.

setUserUsername($newUser) : the function changes the username stored in the database as "cookies['user']" 
with $newUser (so the user must be online) and returns true.
on error the function redirects on "error.php" with $session['last_error'] set.

________________________________________________________________________________________________________________________

functions that require "productUtility.php"

getProductName($product_code): $product_code must be an integer. On success the function returns the name of the product 
linked with the code "$product_code". On error the function redirects on "error.php" with $session['last_error'] set.

getProductDescription($product_code): On success the function returns the description of the product 
linked with the code "$product_code". On error the function redirects on "error.php" with $session['last_error'] set.

getProductPrice($product_code): On success the function returns the price of the product 
linked with the code "$product_code". On error the function redirects on "error.php" with $session['last_error'] set. 

getProductImg($product_code): On success the function returns the html string of the product 
linked with the code "$product_code" in the format "<img width = "100" height="100" src='img_path'>".
On error the function redirects on "error.php" with $session['last_error'] set. 

setproductName($product_code,$newName) : on success the function changes the name of the product (linked with teh code "$product_code)
with "$newName" and returns true. On error the function redirects on "error.php" with $session['last_error'] set.

setproductDescription($product_code,$newDescription): on success the function changes the description of the product (linked with teh code "$product_code)
with "$newDescription" and returns true. On error the function redirects on "error.php" with $session['last_error'] set.
 
setproductPrice($product_code,$newPrice) :  on success the function changes the price of the product (linked with teh code "$product_code)
with "$newPrice" and returns true. On error the function redirects on "error.php" with $session['last_error'] set.

insertNewProduct($code,$name,$description,$price,$img_path): the functions on success stores the new product informations in the database
and returns true. The $code must be unique, if you put an already used code you will get an error. 
On error the function redirects on "error.php" with $session['last_error'] set.

