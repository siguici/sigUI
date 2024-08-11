.PHONY: install install-js install-php check fix build test debug

install: install-js install-php

node_deps: node_modules pnpm-lock.yaml

node_modules: package.json packages/ui/package.json website/package.json
	pnpm i -r

pnpm-lock.yaml: package.json packages/ui/package.json website/package.json
	pnpm up -r

php_deps: vendor composer.lock

vendor: composer.json
	composer i

composer.lock: composer.json
	composer up

check: install
	pnpm check
	composer check

fix: install
	pnpm fix
	composer fix

build: fix
	pnpm build

test: install
	pnpm test
	composer test

debug: install
	pnpm debug
	composer debug
