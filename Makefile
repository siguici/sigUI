.PHONY: install install-js install-php check fix test debug

install: install-js install-php

node_deps: node_modules pnpm-lock.yaml

node_modules: package.json
	pnpm i

pnpm-lock.yaml: package.json
	pnpm up

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

test: install
	pnpm test
	composer test

debug: install
	pnpm debug
	composer debug
