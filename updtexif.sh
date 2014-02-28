for pic in `find assets/ -iname "*.jpg" -type f`
do
  exiftool $pic > $pic.meta
  printf $(basename $pic) \n;
done