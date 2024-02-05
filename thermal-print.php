<!DOCTYPE html>
<?php 
    include('sessionemp.php');
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Receipt</title>
        <style>
            * {
                font-size: 12px;
                font-family: 'Times New Roman';
            }

            td,
            th,
            tr,
            table {
                border-top: 1px solid black;
                border-collapse: collapse;
            }

            td.description,
            th.description {
                width: 75px;
                max-width: 75px;
            }

            td.quantity,
            th.quantity {
                width: 40px;
                max-width: 40px;
                word-break: break-all;
            }

            td.price,
            th.price {
                width: 40px;
                max-width: 40px;
                word-break: break-all;
            }

            .centered {
                text-align: center;
                align-content: center;
            }

            .ticket {
                width: 155px;
                max-width: 155px;
            }

            img {
                width: 120px;
                max-width: inherit;
                margin: 0 auto;
            }

            @media print {
                .hidden-print,
                .hidden-print * {
                    display: none !important;
                }
            }
        </style>
    </head>
    <body>
        <div class="ticket">
            <p class="centered"><img src="images/vit_logo.jpg" alt="Logo"></p>
            <p class="centered">RECEIPT EXAMPLE
                <br>Address line 1
                <br>Address line 2</p>
            <table>
                <thead>
                    <tr>
                        <th class="description">Item</th>
                        <th class="quantity">Qty</th>
                        <th class="price">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $data = $_SESSION['print_data'];
                        foreach($data as $row) {
                    ?>
                    <tr>
                        <td class="description"><?= $row['name'] ?></td>
                        <td class="quantity"><?= $row['qty'] ?></td>
                        <td class="price">Rs. <?= $row['price'] ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                    <!-- <tr>
                        <td class="quantity">2.00</td>
                        <td class="description">JAVASCRIPT BOOK</td>
                        <td class="price">$10.00</td>
                    </tr>
                    <tr>
                        <td class="quantity">1.00</td>
                        <td class="description">STICKER PACK</td>
                        <td class="price">$10.00</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description">TOTAL</td>
                        <td class="price">$55.00</td>
                    </tr> -->
                </tbody>
            </table>
            <p class="centered">Thanks for your purchase!
                <br>parzibyte.me/blog</p>
        </div>
        <!-- <button id="btnPrint" class="hidden-print">Print</button> -->
        
        <script>
            window.print();
            // const $btnPrint = document.querySelector("#btnPrint");
            // $btnPrint.addEventListener("click", () => {
            //     window.print();
            // });
            setTimeout(() => { window.location.href="http://localhost/canteen-master/emphome.php" }, 2000);
        </script>
        
    </body>
</html>