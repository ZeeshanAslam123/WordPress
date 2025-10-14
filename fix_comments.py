#!/usr/bin/env python3

import re

# Read the file
with open('wp-content/plugins/swrice-plugin-page-manager/swrice-plugin-page-manager.php', 'r') as f:
    content = f.read()

# Split into lines
lines = content.split('\n')

# Process each line
for i, line in enumerate(lines):
    # Skip the plugin header block (lines 2-13 approximately)
    if i >= 2 and i <= 13:
        continue
    
    # Skip the main class comment (already fixed)
    if i == 27:
        continue
        
    # Look for standalone comment lines that start with " * " (malformed)
    if re.match(r'^\s*\*\s+.*$', line) and not re.match(r'^\s*\*/\s*$', line):
        # Check if this is a function comment by looking at the next non-empty line
        next_line_idx = i + 1
        while next_line_idx < len(lines) and lines[next_line_idx].strip() == '':
            next_line_idx += 1
        
        if next_line_idx < len(lines):
            next_line = lines[next_line_idx].strip()
            # If next line is a function/method declaration, fix this comment
            if (next_line.startswith('public function') or 
                next_line.startswith('private function') or 
                next_line.startswith('protected function')):
                
                # Extract the comment text
                comment_text = re.sub(r'^\s*\*\s*', '', line)
                
                # Replace with proper PHPDoc block
                indent = len(line) - len(line.lstrip())
                indent_str = ' ' * indent
                
                lines[i] = f"{indent_str}/**\n{indent_str} * {comment_text}\n{indent_str} */"

# Write back to file
with open('wp-content/plugins/swrice-plugin-page-manager/swrice-plugin-page-manager.php', 'w') as f:
    f.write('\n'.join(lines))

print("Fixed malformed comment blocks!")

