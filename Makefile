.PHONY: install check fix test

install: node_modules pnpm-lock.yaml

node_modules: package.json
	pnpm i

pnpm-lock.yaml: package.json
	pnpm up

check: install
	pnpm check

test: install
	pnpm test

fix: install
	pnpm fix
