tmp_dir="shelter-manager"
zip_file="shelter-manager.zip"
exclude_list=(
  "$tmp_dir"
  "$zip_file"
  ".git"
  ".vscode"
  "bash"
  "documentation"
  "node_modules"
  "sass"
  "typescript"
  ".gitignore"
  ".prettierrc.yml"
  "package.json"
  "ReadMe.md"
  "tsconfig.json"
  "yarn.lock"
)

zip_plugin() {
  echo "Zipping plugin..."
  if [ -d "$tmp_dir" ]; then
    rm -r "$tmp_dir"
  fi
  if [ -f "$zip_file" ]; then
    rm "$zip_file"
  fi
  mkdir -p "$tmp_dir"
  for item in *; do
    if [[ ! " ${exclude_list[*]} " =~ " $item " ]]; then
      cp -r "$item" "$tmp_dir"
    fi
  done
  zip -r "$zip_file" "$tmp_dir"
  rm -r "$tmp_dir"
  echo "Zipped plugin"
}

zip_plugin