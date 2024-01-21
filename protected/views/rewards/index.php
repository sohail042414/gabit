<!-- content block -->
   <div class="index-wrapper home-reward mt-3">
      <div class="container-fluid p-0 text-center">
         <div class="row mx-0">
            <div class="col-md-12 px-0">
               <div class="reward-content">
                  <h2 class="date primary-font"><?php echo date('F d, Y',strtotime($reward_date)); ?></h2>
                  <h1 class="reward-text primary-font">REWARD</h1>
                  <div class="ribbon mx-auto">
                     <h2 class=" primary-font"> <span class="system-ui">₦&nbsp;</span><?php echo number_format($reward_prize,0,'.',','); ?></h2>
                  </div>
                  <div class="top-donor mx-auto ">
                     <h2 class="primary-font text-center">
                        The Top Donor <br>
                        Reward Program (TDRP)
                     </h2>
                  </div>

                  <div class="p-a">
                     <p class="primary-font text-black ">Support fundraisers on</p>
                  </div>
                  <div class="giveyourbit-img mx-auto">
                    <a href="https://giveyourbit.com">
                         <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/rewards/images/Giveyourbit_logo.png" alt=""> 
                    </a>
                  </div>

                  <div class="p-b mx-auto">
                     <p class="secondary-font">Get rewarded for your acts of kindness</p>
                  </div>
                  <div class="terms-button">
                     <a href="<?php echo Yii::app()->createUrl('rewards/terms'); ?>" class="text-white secondary-font">Terms & Conditions</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="index-white-block"></div>
   </div>
