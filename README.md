# Dolibarr debug

<div style="text-align: center">

English | [Français](https://github.com/artis-auxilium/dolibarr_debug/blob/main/README.fr.md)
</div>
Debugging tool for Dolibarr.

It integrates [Laradump](https://laradumps.dev/) [(github)](https://github.com/laradumps/laradumps) 

## Installation

1. Install composer dependencies

```bash
compose install
```

2. Install the [Laradump desktop software](https://laradumps.dev/get-started/installation.html?id=desktop-app#desktop-app)

3. Activate the module.
4. You can now use Laradump in Dolibarr with the function `ds()`. 
Open [Url_dolibarr]/debug/example.php