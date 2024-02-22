<!-- START FOOTER -->
<footer class="bg_dark footer_dark">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bottom_footer border-top-tran">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-md-0 text-center text-md-left">© <?= date('Y'); ?> All Rights Reserved by <span class="text_default">Pannash Greens</span></p>
                        </div>
                        <?php if(isset($_SESSION['cust_user']) || isset($_SESSION['emp_user'])) { ?>
                        <div class="col-md-6">
                            <ul class="list_none footer_link text-center text-md-right">                                
                                <li><a href="<?= isset($_SESSION['cust_user'])?'emphome.php':'homepage.php' ?>">Home</a></li>
                                <li><a href="terms-conditions.php">Terms &amp; Conditions</a></li>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->