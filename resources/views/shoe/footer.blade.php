<!-- footer.blade.php -->
<footer>
    <div class="footer-content">
        <p>&copy; {{ date('Y') }} Ocelot Store. Todos os direitos reservados.</p>
    </div>
</footer>

<style>
    /* Garante que o conteúdo ocupe todo o espaço disponível */
    body, html {
        height: 100%;
        margin: 0;
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Altura mínima de 100% da tela */
    }

    main {
        flex: 1; /* Faz o conteúdo principal ocupar todo o espaço disponível */
    }

    footer {
        margin-top: 50px;
        background-color: #1f1f1f;
        color: white;
        text-align: center;
        padding: 50px;
        width: 100%;
        /* Se o footer não deve ser fixo, retire a posição 'fixed' */
    }

    .footer-content ul {
        list-style: none;
        padding: 0;
    }

    .footer-content ul li {
        display: inline;
        margin: 0 10px;
    }

    .footer-content ul li a {
        color: white;
        text-decoration: none;
    }

    .footer-content ul li a:hover {
        text-decoration: underline;
    }
</style>
