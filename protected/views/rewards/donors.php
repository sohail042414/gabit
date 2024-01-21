   <!-- content block -->
   <div class="container-fluild mt-5 content-block">
      <div class="main-donor-reward">
         <div class="container">
            <h2 class="same-heading same-heading-pb">
               TDRP for Donors
            </h2>
            <div class="inner-donor-container top-hr">
               <div class="row">
                  <div class="col-md-8">
                     <div class="donor-reward">
                        <!-- <h4 class="text-center text-md-start caption-style">The Top Donor Reward Program (TDRP)</h4> -->
                        <div class="donor-reward-text paragraph-style text-md-start">
                        <?php echo $trdp_page->page_content; ?>   
                        <!-- <p>
                              This program was created to reward donors monthly for their
                              acts of kindness. However, only one donor would receive the
                              reward for this month, and that donor might just be you. A
                              reward card is issued every 3o days with the value and date of
                              the next reward. Below is the reward card for the 30th of May,
                              2023. The monetary value on this card can be yours!
                           </p> -->
                        </div>
                        <p class="reward-footer">
                           Start supporting fundraisers on Giveyourbit
                           <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Tap here to return to Giveyourbit!</a>
                        </p>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="reward-img">
                        <img class="certificate" src="<?php echo Yii::app()->request->baseUrl; ?>/css/rewards/images/certificate.svg" alt="Certificate">
                     </div>
                  </div>
               </div>
            </div>
            <div class="work-text-container top-hr">
               <h4 class="text-center same-heading text-md-start caption-style">How this works</h4>
               <div class="work-text text-start paragraph-style">
                  <?php echo $how_it_works_page->page_content; ?> 
                  <!-- <p>There are a number of actions that can be done on a fundraiser
                     page i.e. donate now, send a hug, social media share, Facebook
                     comment, become a supporter, view case updates, embed fundraiser
                     on a website or blog, and from supporter dashboard i.e. invite a
                     friend. Each of these actions has a unique number of points that a
                     donor earns every time the action is taken. The donor with the
                     highest cumulative sum of points for actions taken on fundraiser
                     pages on the site is updated to the top of the site donor list.
                     The donor that is on top of the list on the 30th and last day of
                     the list (28th or 29th day on a February) gets the top donor
                     reward.
                  </p>
                  <p>
                     A donation is what makes one a donor, so if a person has not made
                     a donation within the 30 days, the person will not make the donor
                     list in that month in spite of any other actions done on
                     fundraiser pages. There is no tie if two top donors have the same
                     number of points; the one that first achieved the points remains
                     top most on the list.
                  </p>
                  <p>
                     You also earn points by referring donors to support fundraisers;
                     once someone you referred makes a donation, you earn points. And
                     every time they take an action on fundraiser pages, you also earn
                     points. Every tap; every completed action earns you points!
                     The monthly donor list is controlled by a special algorithm, and
                     your name can only make the list for the month when you make a
                     donation; irrespective of how much donation you make. Afterwards,
                     every action you take, including donations on fundraiser pages on
                     the site accrues additional points to your name. The special
                     algorithm constantly updates the list; moving the donors with the
                     highest cumulative points to the top of the list. The name that
                     makes the very top of the list on the 30th or final day gets the
                     Top Donor Reward for the month.
                  </p>
                  <p>
                     The Top Donor is contacted via a recorded phone call and once the
                     terms and conditions are met, the donor is handed a cheque or
                     receives a credit in his account; depending on the preferred
                     option.
                  </p> -->
               </div>
            </div>
         </div>
      </div>
   </div>