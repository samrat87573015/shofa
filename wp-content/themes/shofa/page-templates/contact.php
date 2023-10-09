<?php

/**
* Template Name: Contact
 * @package shofa
 */

get_header();


?>

<main>
   
   <!-- contact-area-start -->
   <section class="contact-area pt-80 pb-80">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-12">
               <div class="tpcontact__right mb-40">
                  <div class="tpcontact__shop mb-30">
                     <h4 class="tpshop__title mb-25">Get In Touch</h4>
                     <div class="tpshop__info">
                        <ul>
                           <li><i class="fal fa-map-marker-alt"></i> <a href="#">24/26 Strait Bargate, Boston, PE21,  United Kingdom</a></li>
                           <li>
                              <i class="fal fa-phone"></i>
                              <a href="tel:0123456789">+098 (905) 786 897 8</a>
                              <a href="tel:0123456789">6 - 146 - 389 - 5748</a>
                           </li>
                           <li>
                              <i class="fal fa-clock"></i>
                              <span>Store Hours:</span>
                              <span>10 am - 10 pm EST, 7 days a week</span>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="tpcontact__support">
                     <a href="tel:0123456">Get Support On Call <i class="fal fa-headphones"></i></a>
                     <a target="_blank" href="https://www.google.com/maps/@36.963672,-119.2249843,7.17z">Get Direction <i class="fal fa-map-marker-alt"></i></a>
                  </div>
               </div>
            </div>
            <div class="col-lg-8 col-12">
               <div class="tpcontact__form">
                  <div class="tpcontact__info mb-35">
                     <h4 class="tpcontact__title">Make Custom Request</h4>
                     <p>Must-have pieces selected every month want style Ideas and Treats?</p>
                  </div>
                  <form action="assets/mail.php" id="contact-form" method="POST">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="tpcontact__input mb-20">
                              <input name="name" type="text" placeholder="Full name" required>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="tpcontact__input mb-20">
                              <input name="email" type="email" placeholder="Email address" required>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="tpcontact__input mb-20">
                              <input name="number" type="text" placeholder="Phone number" required>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="tpcontact__input mb-20">
                              <input name="subject" type="text" placeholder="Subject" required>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="tpcontact__input mb-30">
                              <textarea name="message" placeholder="Enter message" required></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="tpcontact__submit">
                        <button class="tp-btn tp-color-btn tp-wish-cart">Get A Quote <i class="fal fa-long-arrow-right"></i></button>
                     </div>
                  </form>
                  <p class="ajax-response mt-30"></p>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- contact-area-end -->
   <!-- map-area-start -->
   <div class="map-area">
      <div class="tpshop__location-map">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193313.696093143!2d-74.25983952323838!3d40.794422695521675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1663062642075!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
   </div>
   <!-- map-area-end -->
</main>

<?php
get_footer();
