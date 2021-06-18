<div class="cart__mobile">
    <input type="checkbox" id="cart__mobile__button__checkbox">
    <label id="cart__mobile__button__open" class="cart__mobile__button__open cart__mobile__button__icon"
        for="cart__mobile__button__checkbox">
        <i class="fas fa-shopping-cart"></i>
        <div class="cart__mobile__count">{{ (count(Cart::content())) }}</div>
    </label>
    <label for="cart__mobile__button__checkbox" class="cart__mobile__bg"></label>
    <nav class="cart__mobile__container">
        <label class="cart__mobile__button__close cart__mobile__button__icon"
                for="cart__mobile__button__checkbox">
                <i class="fas fa-angle-left"></i>
                
        </label>
        <div class="cart__mobile__container--header">
            Giỏ hàng
        </div>
        @foreach (\Cart::content() as $cart)
        <div class="cart__mobile__container--item">
            <div class="cart__mobile__container--item__img">
                <img src="{{ $cart->id->img }}">
            </div>
            <div class="cart__mobile__container--item__info">
                <h3>{{ $cart->name }}</h3>
                <div class="cart__mobile__container--item__info--price">
                    <small>{{ $cart->qty }}</small> x
                    <span>{{ $cart->price }}</span>
                    <a href="{{ route('cart.deleteRow',['rowId'=>$cart->rowId]) }}">x</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="cart__mobile__container--total">
            <h3>Tạm tính: </h3>
            <span>{{ \Cart::total() }} đ</span>
        </div>
        <a href="{{ route('cart.index') }}" class="cart__mobile__container--btn">Xem giỏ hàng</a>
        <a href="#"  id="cart__payment--btn" class="cart__mobile__container--btn">Thanh toán</a>
        <div class="mb-5"></div>
    </nav>
</div>
