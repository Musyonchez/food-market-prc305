"""Build the two install zips into releases/. Run: python -I scripts/build-zips.py"""
import os
import zipfile

root = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
out_dir = os.path.join(root, "releases")
os.makedirs(out_dir, exist_ok=True)


def walk(base):
    for folder, _, names in os.walk(base):
        for n in names:
            src = os.path.join(folder, n)
            yield src, os.path.relpath(src, base).replace(os.sep, "/")


def build(name, files):
    path = os.path.join(out_dir, name + ".zip")
    with zipfile.ZipFile(path, "w", zipfile.ZIP_DEFLATED) as z:
        for src, arc in files:
            z.write(src, f"{name}/{arc}")
    with zipfile.ZipFile(path) as z:
        assert z.testzip() is None
        print(name, z.namelist())


theme = os.path.join(root, "wp-content", "themes", "mapishi-child")
plug = os.path.join(root, "wp-content", "plugins", "mk-seed")
build("mapishi-child", list(walk(theme)))
build("mk-seed", list(walk(plug)) + [(os.path.join(root, "exports", "sample-products.csv"), "exports/sample-products.csv")])
