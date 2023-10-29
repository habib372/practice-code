<style>
    .signup-steps-panel {
        display: flex;
        -webkit-box-pack: justify;
        justify-content: space-between;
        background-image: linear-gradient(#cccccc, #cccccc);
        background-repeat: no-repeat;
        background-size: 100% 1px;
        background-position: bottom 19px right 20px;
    }
    .signup-step-logo {
        display: inline-block;
        text-align: center;
    }
    .signup-step-logo.is-active .step-circle {
        background: #099dfd;
        border: none;
    }
    .signup-step-logo .step-circle {
        height: 38px;
        width: 38px;
        border-radius: 50%;
        border: 2px solid #cccccc;
        margin: 0 auto;
        background: white;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .signup-step-logo.is-active .index-text {
        color: white;
    }
    .signup-step-logo .step-circle .index-text {
        width: 100%;
        color: #979797;
        font-style: normal;
        font-weight: 500;
        font-size: 18px;
    }
</style>

<div class="mb-3 signup-steps-panel">
    <div class="signup-step-logo is-active">
        <div class="mb-2">Apply</div>
        <div class="step-circle">
            <div class="index-text">1</div>
        </div>
    </div>
    <div class="signup-step-logo">
        <div class="mb-2">Review</div>
        <div class="step-circle">
            <div class="index-text">2</div>
        </div>
    </div>
    <div class="signup-step-logo">
        <div class="mb-2">Recoment/Reject</div>
        <div class="step-circle">
            <div class="index-text">3</div>
        </div>
    </div>
    <div class="signup-step-logo">
        <div class="mb-2">Approve/Reject</div>
        <div class="step-circle">
            <div class="index-text">3</div>
        </div>
    </div>
</div>

