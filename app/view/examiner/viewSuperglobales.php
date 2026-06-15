<section class="two-columns">
    <article class="panel">
        <h1>Session</h1>
        <pre><?= e(print_r($session, true)) ?></pre>
    </article>
    <article class="panel">
        <h1>Cookies</h1>
        <pre><?= e(print_r($cookies, true)) ?></pre>
    </article>
</section>
