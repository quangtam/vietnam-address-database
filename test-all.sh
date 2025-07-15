#!/bin/bash

echo "Testing both JavaScript and PHP packages..."

echo "=== Testing JavaScript ==="
npm test

echo ""
echo "=== Testing PHP ==="
php test-php.php

echo ""
echo "=== Testing Builds ==="
echo "Building JavaScript..."
node build-js.js

echo ""
echo "Building PHP..."
php build-php.php

echo ""
echo "✅ All tests completed!"
