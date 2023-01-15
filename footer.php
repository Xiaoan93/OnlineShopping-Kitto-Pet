
<style>
    *{
        margin: 0;
        padding: 0;
    }

    .footer{
        background: rgb(233, 233, 233);
        width: 100%;
        margin-top: 10%; 
        
    }

    .box-container{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(20rem, 1fr));
        gap: 1rem;
        align-items: flex-start;
        width: 100%;
        text-align: center;
    }

    .footer .box-container .box h3{
        text-transform: uppercase;
        color: #333;
        margin-bottom: 1rem;
        font-size: 1.5rem;
        margin-top: 1rem;
        margin-left: 1rem;
    }
    .footer .box-container a,
    .footer .box-container p
    {
        display: block;
        padding: 0.1rem 0;
        font-size: 0.8rem;
        text-decoration: none;
        color: #333;
        margin-left: 1rem;
    }

    .footer .box-container a:hover{
        text-decoration: underline;
    }

    .footer .copy{
        margin-top: 2rem;
        padding-top: 1rem;
        text-align: center;
        color: #333;
        border-top: 1px solid rgb(12, 12, 12);
        margin-bottom: 0;
    }
    .copy {
        padding-bottom: 12px;
    }
    .clear {
        clear: both;
    }



</style>

<footer class="footer">
<section class="box-container">
    <div class="box">
        <h3>Service</h3>
        <a href="#">Nail-Trimming</a>
        <a href="#">Pet Scale</a>
        <a href="#">Carry-out Service</a>
        <a href="#">Cuddle Hub</a>
    </div>

    <div class="box">
        <h3>Information</h3>
        <a href="#">Contact us</a>
        <a href="#">FAQ</a>
        <a href="#">Return Policy</a>
        <a href="#">Shipping Policy</a>
    </div>

    <div class="box">
        <h3>About us</h3>
        <a href="#">A Great Story</a>
        <a href="#">Company Profile</a>
        <a href="#">Terms of Use</a>
        <a href="#">Blog</a>
    </div>

    <div class="box">
        <h3>Contact info</h3>
        <p><i class="fa fa-phone"></i>&nbsp 514-123-45678</p>
        <p><i class="fa fa-envelope"></i>&nbsp kitto@ask.com</p>
        <p><i class="fa fa-map-marker"></i>&nbsp Montreal, QC</p>
    </div>

 
</section>

<p class="copy"> &copy; Copyright @<?= date('Y');?> By <span>XiaoanLao</span> | All rights served!</p>

</footer>