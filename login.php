<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/styles/salesforce-lightning-design-system.css">
  </head>
  <body>

  <div class="slds-page-header" role="banner">
  <div class="slds-media">
    <div class="slds-media__figure">
      <svg aria-hidden="true" class="slds-icon slds-icon--large slds-icon-standard-opportunity">
        <use xlink:href="/assets/icons/standard-sprite/svg/symbols.svg#opportunity"></use>
      </svg>
    </div>
    <div class="slds-media__body">
      <p class="slds-page-header__title slds-truncate slds-align-middle" title="Rohde Corp - 80,000 Widgets">HealthIsWealth</p>
      <!-- <p class="slds-text-body--small slds-page-header__info">Mark Jaeckal • Unlimited Customer • 11/13/15</p> -->
    </div>
  </div>
</div>
<div style="padding: 25px 10px;">
  <form class="slds-form--inline" action="dashboard.php"> 
      <div class="slds-form-element">
        <label class="slds-form-element__label" for="email">Email</label>
        <div class="slds-form-element__control">
          <input id="email" class="slds-input" type="text" value="sujata.galinde@rainmakers.com" />
        </div>
      </div>
      <div class="slds-form-element">
        <label class="slds-form-element__label" for="name">Password</label>
        <div class="slds-form-element__control">
          <input id="name" class="slds-input" type="text" value="12345678" />
        </div>
      </div>
      <div class="slds-form-element">
        <button class="slds-button slds-button--brand" type="Submit">Login</button>
      </div>
  </form> 
</div>
  </body>
</html>