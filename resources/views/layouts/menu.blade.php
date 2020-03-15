<li class="nav-item {{ Request::is('categories*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('categories.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Categories</span>
    </a>
</li>
<li class="nav-item {{ Request::is('brands*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('brands.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Brands</span>
    </a>
</li>



<li class="nav-item {{ Request::is('coupons*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('coupons.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Coupons</span>
    </a>
</li>

<li class="nav-item {{ Request::is('uniqueCouponUsers*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('unique_coupon_users.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Unique Coupon Users</span>
    </a>
</li>
