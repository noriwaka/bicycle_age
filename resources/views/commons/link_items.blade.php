@if (Auth::check())
    {{-- Editページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('edit') }}">Edit</a></li>
    {{-- Blogページへのリンク --}}
    <li><a class="link link-hover" href="#">Blog</a></li>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">会員登録</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">ログイン</a></li>
@endif