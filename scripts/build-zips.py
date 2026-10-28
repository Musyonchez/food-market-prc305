import zipfile, os, sys
root = r"C:\Users\Admin\Code\johnson"
def build(out, name, files):
    with zipfile.ZipFile(out, "w", zipfile.ZIP_DEFLATED) as z:
        for src, arc in files:
            z.write(src, f"{name}/{arc}")
theme = os.path.join(root, "wp-content", "themes", "mapishi-child")
plug = os.path.join(root, "wp-content", "plugins", "mk-seed")
os.makedirs(os.path.join(root, "dist"), exist_ok=True)
build(os.path.join(root, "dist", "mapishi-child.zip"), "mapishi-child",
      [(os.path.join(theme, f), f) for f in ("style.css", "functions.php")])
build(os.path.join(root, "dist", "mk-seed.zip"), "mk-seed",
      [(os.path.join(plug, "mk-seed.php"), "mk-seed.php"), (os.path.join(plug, "seed.php"), "seed.php"),
       (os.path.join(root, "exports", "sample-products.csv"), "exports/sample-products.csv")])
for n in ("mapishi-child", "mk-seed"):
    with zipfile.ZipFile(os.path.join(root, "dist", n + ".zip")) as z:
        print(n, z.testzip(), z.namelist())
