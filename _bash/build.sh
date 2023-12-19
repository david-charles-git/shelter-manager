js_app_file="app.js"
scss_source_dir="sass"
dist_dir="includes/dist"
ts_source_dir="typescript"
exclude_files=('includes/dist/jquery.js');

build() {
  echo "Building project..."
  echo "Resettind dist directory: $dist_dir"
  if [ -d "$dist_dir" ]; then
    rm -r "$dist_dir"
  fi
  mkdir "$dist_dir"
  compile_typescript
  miniy_javascript
  compile_sass
  minify_css
  echo "Finished building project"
}

compile_typescript() {
  echo "Compiling TypeScript to JavaScript..."
  tsc
  touch "$js_app_file"
  for js_file in "$dist_dir"/*.js; do
    if [[ ! " $exclude_files " =~ " $js_file " ]]; then
      if [ -e "$js_file" ]; then
        cat "$js_file" >> "$js_app_file"
        echo -e "\n" >> "$js_app_file"
        rm "$js_file"
      fi
    fi
  done
  mv "$js_app_file" "$dist_dir/$js_app_file"
  echo "Compiled TypeScript to JavaScript"
}
miniy_javascript() {
  echo "Minifying JavaScript..."
  for js_file in "$dist_dir"/*.js; do
    if [ -f "$js_file" ]; then
      file_name="${js_file##*/}"
      file_name="${file_name%.*}"
      file_path="${js_file%/*}/${file_name}.min.js"
      yarn uglifyjs "$js_file" -o "$file_path"
    fi
  done
  echo "Minified JavaScript"
}
compile_sass() {
  echo "Compiling SASS to CSS..."
  for scss_file in "$scss_source_dir"/*.scss; do
  css_file="${scss_file%/*}/$(basename "$scss_file" .scss).css"
    if [[ ! " $exclude_files " =~ " $scss_file " ]]; then
      if [ -f "$scss_file" ]; then
        file_name=$(basename "$scss_file" .scss)
        file_path="$dist_dir/$file_name.css"
        sass "$scss_file" "$file_path"
      fi
    fi
  done
  echo "Compiled SASS to CSS"
}
minify_css() {
  echo "Minifying CSS..."
  for css_file in "$dist_dir"/*.css; do
    if [ -f "$css_file" ]; then
      file_name=$(basename "$css_file" .css)
      file_path="$dist_dir/$file_name.min.css"
      yarn uglifycss "$css_file" > "$file_path"
      tail -n +2 "$file_path" > "$file_path.tmp"
      mv "$file_path.tmp" "$file_path"
    fi
  done
  echo "Minified CSS"
}

build