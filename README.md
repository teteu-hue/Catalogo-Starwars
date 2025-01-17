# Catalogo Starwars

## Diagramas e Fluxogramas
[Acesse os diagramas e fluxogramas da aplicação](https://excalidraw.com/#room=7467338f775316b1f4c4,WP3A_TXNdSkw-dIMbXLSuw)

## Como Rodar o projeto

### Entre na pasta htdocs(Windows) ou html(Linux) -> cd /var/www/html/

#### (Ubuntu)
Verifique se o servidor apache está funcionando
```bash
sudo systemctl status apache2
```

#### Realize um git clone do repositório
```bash
git clone https://github.com/teteu-hue/Catalogo-Starwars.git
```

#### Entre na pasta "Catalogo-Starwars"
```bash
cd Catalogo-Starwars
```

#### Rode a API do projeto
```bash
php -S localhost:8081 -t backend/public
```

#### Rodar o front-end
Para isso entre no seu navegador de preferência e digite:
```bash
localhost/catalogo-filmes/frontend/src/home.view.php
```
