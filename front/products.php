<?php
require('../../controller/ProduitC.php');
require('../../controller/CategorieC.php');
require('../../controller/AchatC.php');
require('../../controller/mail.php');

$prodC = new ProduitC();
$catC = new CategorieC();
$achatC = new AchatC();
$listCategories = $catC->afficherCategorie();
$lastSave = $achatC->getLastId();
$lastId = $lastSave['id_achat'] + 1;
$bestSelling = $achatC->bestSellingProduct();
if (isset($_POST['id_prod'])) {
    $idProd = $_POST['id_prod']; 
    echo "<script>
    setTimeout(function() {
        window.location.href = 'sendMailFacture.php?idProd=$idProd&lastId=$lastId';
    }, 500);
  </script>";
}
// pagination 
$per_page_record = 6;  // Number of entries to show in a page.   
// Look for a GET variable page if not found default is 1.        
if (isset($_GET["page"])) {    
    $page  = $_GET["page"];    
}    
else {    
  $page=1;    
}    
$start_from = ($page-1) * $per_page_record;
/////////LIMIT
if(isset($_POST['filter'])){
    if($_POST['filter'] == "All"){
        $sqlSearch="SELECT * FROM produits LIMIT $start_from, $per_page_record";
    } else {
$id = $_POST['filter'];
$sqlSearch="SELECT * FROM produits INNER JOIN categories on produits.id_cat = categories.id_cat WHERE categories.id_cat = $id LIMIT $start_from, $per_page_record"; }
} else if(isset($_POST['search']))
{
    $search = $_POST['search'];
    $sqlSearch="SELECT * FROM produits WHERE id = '$search' OR nom = '$search' LIMIT $start_from, $per_page_record";
} else 
$sqlSearch="SELECT * FROM produits LIMIT $start_from, $per_page_record";
$query = $prodC->paginationLIMIT($sqlSearch);
////////////COUNTER
$sql = "SELECT COUNT(*) FROM produits";
$total_recordse=$prodC->paginationCOUNTER($sql);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Kool Form Pack | Coming Soon Page</title>

        <!-- CSS FILES -->                
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,700;1,200&family=Unbounded:wght@400;700&display=swap" rel="stylesheet">
        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/tooplate-kool-form-pack.css" rel="stylesheet">
        <!--=============== FAVICON ===============-->
        <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

        <!--=============== REMIX ICONS ===============-->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

        <!--=============== SWIPER CSS ===============-->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="css/produit.css">
        <!-- Inclure la bibliothèque jsPDF -->
        <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>
        
<!--

Tooplate 2136 Kool Form Pack

https://www.tooplate.com/view/2136-kool-form-pack

Bootstrap 5 Form Pack Template

-->
    </head>
    
    <body>

        <main>

            <header class="site-header">
                <div class="container">
                    <div class="row justify-content-between">

                        <div class="col-lg-12 col-12 d-flex align-items-center">
                            <a class="site-header-text d-flex justify-content-center align-items-center me-auto" href="index.html">
                                <i class="bi-box"></i>

                                <span>
                                    Kool Form Pack
                                </span>
                            </a>

                            <ul class="social-icon d-flex justify-content-center align-items-center mx-auto">
                                <span class="text-white me-4 d-none d-lg-block">Stay connected</span>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-instagram"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-twitter"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-whatsapp"></a>
                                </li>
                            </ul>

                            <div>
                                <a href="#" class="custom-btn custom-border-btn btn" data-bs-toggle="modal" data-bs-target="#subscribeModal">Notify me
                                    <i class="bi-arrow-right ms-2"></i>
                                </a>
                            </div>

                            <a class="bi-list offcanvas-icon" data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu"></a>

                        </div>

                    </div>
                </div>
            </header>


            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">                
                <div class="offcanvas-header">                    
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                
                <div class="offcanvas-body d-flex flex-column justify-content-center align-items-center">
                    <nav>
                        <ul>
                            <li>
                                <a href="login.html">Login Form</a>
                            </li>
                            <li>
                                <a href="products.php">Products</a>
                            </li>
                            <li>
                                <a href="register.html">Create an account</a>
                            </li>

                            <li>
                                <a href="password-reset.html">Password Reset</a>
                            </li>

                            <li>
                                <a href="404.html">404 Page</a>
                            </li>

                            <li>
                                <a href="contact.html">Contact Form</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="#" method="get" class="custom-form mt-lg-4 mt-2" role="form">
                                <h2 class="modal-title" id="subscribeModalLabel">Stay up to date</h2>

                                <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="your@email.com" required="">

                                <button type="submit" class="form-control">Notify</button>
                            </form>
                        </div>

                        <div class="modal-footer justify-content-center">
                            <p>By signing up, you agree to our Privacy Notice</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Best Product -->
            <section class="featured section" id="featured">
                    <h2 class="section__title">
                        BEST-Selling
                    </h2>
                        <br>             
                    <div class="featured__container container">
                        <div class="featured__content grid">
                        <?php  
                        foreach($bestSelling as $p) {
                            $cat = $catC->recupererCategorie($p['id_cat']);
                        ?>
                            <article class="featured__card mix tesla">
                                <div class="shape shape__smaller"></div>

                                <h1 class="featured__title"><?php echo $p['nom']; ?></h1>

                                <h3 class="featured__subtitle"><?php echo $cat['nom_cat']; ?></h3>

                                <img src="assets/img/<?php echo $p['image']; ?>" alt="" class="featured__img">

                                <h3 class="featured__price"><?php echo $p['prix']; ?> TND</h3>
                                <form action="products.php" method="post" id="achatForm">
                                <button class="button featured__button" onclick="generatePdf('<?php echo $p['id']; ?>','<?php echo $p['nom']; ?>','<?php echo $p['description']; ?>','<?php echo $p['prix']; ?>','<?php echo $cat['nom_cat']; ?>')">
                                    <input type="text" name="id_prod" value="<?php echo $p['id']; ?>" hidden>
                                    <i class="ri-shopping-bag-2-line"></i>
                                </button>
                                </form>
                            </article>   
                            <?php } ?>                          
                        </div>
                        </section>
                <!--==================== PRODUCTS START ====================-->
                <section class="featured section" id="featured">
                    <h2 class="section__title">
                        Products List
                    </h2>
                        <div class="box">
                            <form action="products.php" method="post">
                                <input type="text" class="input" id="recherche_produit" name="search" placeholder="Recherche">
                            </form>
                                <i class="bi bi-filter"></i>
                                <form action="products.php" method="post" id="filterForm">
                                <select class="select" id="filter_produit" name="filter" onchange="submitForm()">
                                <?php foreach($listCategories as $c) { ?>
                                    <option value="<?php echo $c['id_cat'] ?>"><?php echo $c['nom_cat'] ?></option>
                                    <?php } ?>
                                    <option value="All">All</option>
                                </select> 
                                </form>                             
                        </div> 
                        <br>             
                    <div class="featured__container container">
                        <div class="featured__content grid">
                        <?php  
                        foreach($query as $p) {
                            $cat = $catC->recupererCategorie($p['id_cat']);
                        ?>
                            <article class="featured__card mix tesla">
                                <div class="shape shape__smaller"></div>

                                <h1 class="featured__title"><?php echo $p['nom']; ?></h1>

                                <h3 class="featured__subtitle"><?php echo $cat['nom_cat']; ?></h3>

                                <img src="assets/img/<?php echo $p['image']; ?>" alt="" class="featured__img">

                                <h3 class="featured__price"><?php echo $p['prix']; ?> TND</h3>
                                <form action="products.php" method="post" id="achatForm">
                                <button class="button featured__button" onclick="generatePdf('<?php echo $p['id']; ?>','<?php echo $p['nom']; ?>','<?php echo $p['description']; ?>','<?php echo $p['prix']; ?>','<?php echo $cat['nom_cat']; ?>')">
                                    <input type="text" name="id_prod" value="<?php echo $p['id']; ?>" hidden>
                                    <i class="ri-shopping-bag-2-line"></i>
                                </button>
                                </form>
                            </article>   
                            <?php } ?>                          
                        </div>
                        <div class="pagination" style="padding-left:40%;">    
      <?php      
        $total_records =$prodC->paginationCOUNTER($sql);      
          
    echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='products.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='products.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='products.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='products.php?page=".($page+1)."'>  Next </a>";   
        }  
  
      ?>    
      </div> 
<script>
        /* start PDF */
    function generatePdf(idProd,nomProd,desc,prix,nomCat){
        var props = {
        outputType: jsPDFInvoiceTemplate.OutputType.Save,
        returnJsPDFDocObject: true,
        fileName: "Invoice"+"<?php echo $lastId ?>",
        orientationLandscape: false,
        compress: true,
        logo: {
            src: "tunisia.png",
            type: 'PNG', //optional, when src= data:uri (nodejs case)
            width: 53.33, //aspect ratio = width/height
            height: 26.66,
            margin: {
                top: 0, //negative or positive num, from the current position
                left: 0 //negative or positive num, from the current position
            }
        },
        stamp: {
            inAllPages: true, //by default = false, just in the last page
            src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
            type: 'JPG', //optional, when src= data:uri (nodejs case)
            width: 20, //aspect ratio = width/height
            height: 20,
            margin: {
                top: 0, //negative or positive num, from the current position
                left: 0 //negative or positive num, from the current position
            }
        },
        business: {
            name: "Musicfest",
            address: "Tunsia, Ariana, Elghazela 2083",
            phone: "75 250 005",
            email: "supprot@musicfest.com",
            website: "www.musicfest.com",
        },
        contact: {
            label: "Invoice issued for:",
            name: "Nefzi Eya",
            address: "Tunsia, Ariana, Elghazela 2083",
            phone: "(+216) 99 999 999",
            email: "eya.nefzi@esprit.tn",
        },
        invoice: {
            invDate: "Date: "+new Date(),
            headerBorder: false,
            tableBodyBorder: false,
            header: [
            {
                title: "#", 
                style: { 
                width: 10 
                } 
            }, 
            { 
                title: "Product Name",
                style: {
                width: 30
                } 
            }, 
            { 
                title: "Description",
                style: {
                width: 80
                } 
            }, 
            { title: "Price"},
            { title: "Category"}
            ],
            table: [   
                    [idProd, nomProd,desc, prix+" TND", nomCat]
                ],
        },
        footer: {
            text: "The invoice is created on a computer and is valid without the signature and stamp.",
        },
        pageEnable: true,
        pageLabel: "Page ",
    };
    var pdfObject = jsPDFInvoiceTemplate.default(props);
    document.getElementById("achatForm").submit();
    }
    /* end pdf */
    function searchFun() {
    var input, filter, grid, articles, title, subtitle, txtValue;
    input = document.getElementById("recherche_produit");
    filter = input.value.toUpperCase();
    grid = document.querySelector(".featured__content");
    articles = grid.getElementsByClassName("featured__card");

    for (var i = 0; i < articles.length; i++) {
        title = articles[i].getElementsByClassName("featured__title")[0];
        subtitle = articles[i].getElementsByClassName("featured__subtitle")[0];

        if (title || subtitle) {
            txtValue = (title ? title.textContent || title.innerText : "") +
                       (subtitle ? subtitle.textContent || subtitle.innerText : "");

            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                articles[i].style.display = "";
            } else {
                articles[i].style.display = "none";
            }
        }
    }
}
</script>
                        <style>
  .pagination {
    padding-left: 40%;
    margin-top: 20px; 
  }

  .pagination a {
    color: black;
    background-color: white;
    padding: 8px 12px;
    text-decoration: none;
    border-radius: 4px;
    margin: 0 4px;
  }

  .pagination a.active {
    background-color: #F2CC8F;
    color: white;
  }
</style>
                    </div>
                </section>
        </main>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/countdown.js"></script>
        <script src="js/init.js"></script>
        <!--=============== SCROLL REVEAL ===============-->
        <script src="assets/js/scrollreveal.min.js"></script>

        <!--=============== SWIPER JS ===============-->
        <script src="assets/js/swiper-bundle.min.js"></script>

        <!--=============== MIXITUP JS ===============-->
        <script src="assets/js/mixitup.min.js"></script>

        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>
        <script src="js/produit.js"></script>

    </body>
</html>
