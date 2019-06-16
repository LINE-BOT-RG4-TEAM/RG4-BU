<div id="circularMenu" class="circular-menu">
    <a class="floating-btn" onclick="toggle_menu()">       
            <i class="fas fa-bars" style="color:white;"></i>
            <span class="badge badge-float badge-danger badge-counter" id="notify_total">0</span>
    </a>
    <menu class="items-wrapper" id="menu_item">
        <a href="#" class="menu-item fas fa-shopping-cart" data-toggle='modal' data-target='#cartModal'><span class="badge badge-danger badge-counter" id="notify_cart">0</span></a>
        <a href="#" class="menu-item fas fa-history"></a>
        <a href="?action=purchase_status" class="menu-item fas fa-list-alt"><span class="badge badge-danger badge-counter" id="pending_count">0</span></a>
        <a href="#" class="menu-item fas fa-user"></a>
    </menu>
</div>
<div class='modal fade' tabindex='-1' role='dialog' id='cartModal'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title font-weight-bold' id="head_modal"><i class='fas fa-shopping-cart'></i> รายการบริการ</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body' id='lineitem_area'>
                </div>
                <div class='modal-footer'>
                    <a type='button' class='btn btn-primary'  href="#" id="check_out">ยืนยัน</a>
                    <button type='button' class='btn btn-primary' data-dismiss='modal' >ปิด</button>
                </div>
            </div>
        </div>
    </div>
<style>
    /* HTML  CSS Result
    EDIT ON */
    body {
            background-color: #EDEDED;
        }
    .circular-menu {
    position: fixed;
    bottom: 1em;
    right: 1em;
    }

    .circular-menu .floating-btn {
    display: block;
    width: 3.5em;
    height: 3.5em;
    border-radius: 50%;
    background-color:hsl(276, 40%, 41%);
    box-shadow: 0 2px 5px 0 hsla(0, 0%, 0%, .26);  
    color: hsl(0, 0%, 100%);
    text-align: center;
    line-height: 3.9;
    cursor: pointer;
    outline: 0;
    }

    .circular-menu.active .floating-btn {
    box-shadow: inset 0 0 3px hsla(0, 0%, 0%, .3);
    }

    .circular-menu .floating-btn:active {
    box-shadow: 0 4px 8px 0 hsla(0, 0%, 0%, .4);
    }

    .circular-menu .floating-btn i {
    font-size: 1.3em;
    transition: transform .2s;  
    }

    .circular-menu.active .floating-btn i {
    transform: rotate(45deg);
    }

    .circular-menu:after {
    display: block;
    content: ' ';
    width: 3.5em;
    height: 3.5em;
    border-radius: 50%;
    position: absolute;
    top: 0;
    right: 0;
    z-index: -2;
    background-color: hsl(276, 40%, 41%,0.3);
    transition: all .3s ease;
    }

    .circular-menu.active:after {
    transform: scale3d(5.5, 5.5, 1);
    transition-timing-function: cubic-bezier(.68, 1.55, .265, 1);
    }

    .circular-menu .items-wrapper {
    padding: 0;
    margin: 0;
    }

    .circular-menu .menu-item {
    position: absolute;
    top: .2em;
    right: .2em;
    z-index: -1;
    display: block;
    text-decoration: none;
    color: hsl(0, 0%, 100%);
    font-size: 1em;
    width: 3em;
    height: 3em;
    border-radius: 50%;
    text-align: center;
    line-height: 3;
    background-color: hsla(276,40%,41%,1);
    transition: transform .3s ease, background .2s ease;
    }

    .circular-menu .menu-item:hover {
    background-color: hsla(0,0%,0%,.3);
    }

    .circular-menu.active .menu-item {
    transition-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .circular-menu.active .menu-item:nth-child(1) {
    transform: translate3d(1em,-7em,0);
    }

    .circular-menu.active .menu-item:nth-child(2) {
    transform: translate3d(-3.5em,-6.3em,0);
    }

    .circular-menu.active .menu-item:nth-child(3) {
    transform: translate3d(-6.5em,-3.2em,0);
    }

    .circular-menu.active .menu-item:nth-child(4) {
    transform: translate3d(-7em,1em,0);
    }

    /*.circular-menu.active .badge {
        display: block;
        position: absolute;
        top: -5px;
        right: -5px;
        }*/
    
    .circular-menu .badge {
        display: none;
        position: absolute;
        top: -5px;
        right: -5px;
        }

        .circular-menu .badge-float {
        display: block;
        position: absolute;
        top: -5px;
        right: -5px;
        }

       /*.circular-menu.active .badge-float {
        display: none;
        position: absolute;
        top: -5px;
        right: -5px;
        }*/
    




</style>