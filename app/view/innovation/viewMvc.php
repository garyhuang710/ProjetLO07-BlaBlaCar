<section class="panel">
    <h1>Innovation MVC</h1>
    <p>Le routeur centralise toutes les actions autorisees dans une table de correspondance. Cette approche garde le principe LO07 des methodes statiques, tout en evitant qu une methode non prevue soit appelee depuis l URL.</p>
    <p>Les controles d acces sont factorises dans le controleur parent avec <code>requireRole</code>. Les vues restent limitees a l affichage, les requetes SQL sont dans les modeles, et la cloture d un trajet utilise une transaction pour garder les soldes coherents.</p>
</section>
