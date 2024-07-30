<template>
    <div
        v-if="editor && !viewOnly"
        class="p-4 border-gray-300 border flex items-center flex-wrap gap-2"
    >
        <button
            @click="editor.chain().focus().toggleBold().run()"
            :disabled="!editor.can().chain().focus().toggleBold().run()"
            :class="{ 'is-active': editor.isActive('bold') }"
            class="p-1 border border-gray-300"
        >
            bold
        </button>
        <button
            @click="editor.chain().focus().toggleItalic().run()"
            :disabled="!editor.can().chain().focus().toggleItalic().run()"
            :class="{ 'is-active': editor.isActive('italic') }"
            class="p-1 border border-gray-300"
        >
            italic
        </button>
        <button
            @click="editor.chain().focus().toggleStrike().run()"
            :disabled="!editor.can().chain().focus().toggleStrike().run()"
            :class="{ 'is-active': editor.isActive('strike') }"
            class="p-1 border border-gray-300"
        >
            strike
        </button>
        <button
            @click="editor.chain().focus().toggleCode().run()"
            :disabled="!editor.can().chain().focus().toggleCode().run()"
            :class="{ 'is-active': editor.isActive('code') }"
            class="p-1 border border-gray-300"
        >
            code
        </button>
        <button
            @click="editor.chain().focus().unsetAllMarks().run()"
            class="p-1 border border-gray-300"
        >
            clear marks
        </button>
        <button
            @click="editor.chain().focus().clearNodes().run()"
            class="p-1 border border-gray-300"
        >
            clear nodes
        </button>
        <button
            @click="editor.chain().focus().setParagraph().run()"
            :class="{ 'is-active': editor.isActive('paragraph') }"
            class="p-1 border border-gray-300"
        >
            paragraph
        </button>
        <button
            @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
            class="p-1 border border-gray-300"
        >
            h1
        </button>
        <button
            @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }"
            class="p-1 border border-gray-300"
        >
            h2
        </button>
        <button
            @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }"
            class="p-1 border border-gray-300"
        >
            h3
        </button>
        <button
            @click="editor.chain().focus().toggleHeading({ level: 4 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }"
            class="p-1 border border-gray-300"
        >
            h4
        </button>
        <button
            @click="editor.chain().focus().toggleHeading({ level: 5 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }"
            class="p-1 border border-gray-300"
        >
            h5
        </button>
        <button
            @click="editor.chain().focus().toggleHeading({ level: 6 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }"
            class="p-1 border border-gray-300"
        >
            h6
        </button>
        <button
            @click="editor.chain().focus().toggleBulletList().run()"
            :class="{ 'is-active': editor.isActive('bulletList') }"
            class="p-1 border border-gray-300"
        >
            bullet list
        </button>
        <button
            @click="editor.chain().focus().toggleOrderedList().run()"
            :class="{ 'is-active': editor.isActive('orderedList') }"
            class="p-1 border border-gray-300"
        >
            ordered list
        </button>
        <button
            @click="editor.chain().focus().toggleCodeBlock().run()"
            :class="{ 'is-active': editor.isActive('codeBlock') }"
            class="p-1 border border-gray-300"
        >
            code block
        </button>
        <button
            @click="editor.chain().focus().toggleBlockquote().run()"
            :class="{ 'is-active': editor.isActive('blockquote') }"
            class="p-1 border border-gray-300"
        >
            blockquote
        </button>
        <button
            @click="editor.chain().focus().setHorizontalRule().run()"
            class="p-1 border border-gray-300"
        >
            horizontal rule
        </button>
        <button
            @click="editor.chain().focus().setHardBreak().run()"
            class="p-1 border border-gray-300"
        >
            hard break
        </button>
        <button
            @click="editor.chain().focus().undo().run()"
            :disabled="!editor.can().chain().focus().undo().run()"
            class="p-1 border border-gray-300"
        >
            undo
        </button>
        <button
            @click="editor.chain().focus().redo().run()"
            :disabled="!editor.can().chain().focus().redo().run()"
            class="p-1 border border-gray-300"
        >
            redo
        </button>
    </div>
    <editor-content :editor="editor" />
</template>

<!-- <script setup>
import { useEditor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";
import Heading from "@tiptap/extension-heading";
import Paragraph from "@tiptap/extension-paragraph";
import Text from "@tiptap/extension-text";
import Italic from "@tiptap/extension-italic";
import Bold from "@tiptap/extension-bold";
import Strike from "@tiptap/extension-strike";
import Code from "@tiptap/extension-code";

const initialContent = `<h2>
          Hi there,
        </h2>
        <p>
          this is a <em>basic</em> example of <strong>tiptap</strong>. Sure, there are all kind of basic text styles you’d probably expect from a text editor. But wait until you see the lists:
        </p>
        <ul>
          <li>
            That’s a bullet list with one …
          </li>
          <li>
            … or two list items.
          </li>
        </ul>
        <p>
          Isn’t that great? And all of that is editable. But wait, there’s more. Let’s try a code block:
        </p>
        <pre><code class="language-css">body {
  display: none;
}</code></pre>
        <p>
          I know, I know, this is impressive. It’s only the tip of the iceberg though. Give it a try and click a little bit around. Don’t forget to check the other examples too.
        </p>
        <blockquote>
          Wow, that’s amazing. Good work, boy! 👏
          <br />
          — Mom
        </blockquote>
`;

const props = defineProps(["modelValue"]);
const emit = defineEmits(["update:modelValue"]);

const editor = useEditor({
    editorProps: {
        attributes: {
            class: "border border-gray-300 p-4 min-h-[12rem] max-h-[12rem] overflow-auto",
        },
        transformPastedText(text) {
            return text.toUpperCase();
        },
    },
    content: props.modelValue,
    extensions: [
        StarterKit,
        Heading.configure({
            levels: [1, 2],
        }),
        Paragraph,
        Text,
        Italic,
        Bold,
        Strike,
        Code,
    ],
    onUpdate: () => {
        emit("update:modelValue", editor.value);
    },
});
</script> -->

<script>
import StarterKit from "@tiptap/starter-kit";
import { Editor, EditorContent } from "@tiptap/vue-3";
import Heading from "@tiptap/extension-heading";
import Paragraph from "@tiptap/extension-paragraph";
import Text from "@tiptap/extension-text";
import Italic from "@tiptap/extension-italic";
import Bold from "@tiptap/extension-bold";
import Strike from "@tiptap/extension-strike";
import Code from "@tiptap/extension-code";
import BulletList from "@tiptap/extension-bullet-list";
import ListItem from "@tiptap/extension-list-item";

export default {
    components: {
        EditorContent,
    },

    props: {
        modelValue: {
            type: String,
            default: "",
        },
        viewOnly: {
            type: Boolean,
            default: false,
        },
    },

    emits: ["update:modelValue"],

    data() {
        return {
            editor: null,
        };
    },
    computed: {
        editorClasses() {
            return `${
                !this.viewOnly
                    ? "p-4  border border-gray-300 min-h-[12rem] max-h-[12rem] overflow-auto "
                    : "pb-6"
            }`;
        },
    },
    watch: {
        modelValue(value) {
            // HTML
            const isSame = this.editor.getHTML() === value;

            // JSON
            // const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)

            if (isSame) {
                return;
            }

            this.editor.commands.setContent(value, false);
        },
    },

    mounted() {
        this.editor = new Editor({
            editorProps: {
                attributes: {
                    class: this.editorClasses,
                },
                transformPastedText(text) {
                    return text.toUpperCase();
                },
            },
            extensions: [
                StarterKit,
                Heading.configure({
                    levels: [1, 2, 3, 4, 5, 6],
                }),
                Paragraph,
                Text,
                Italic,
                Bold,
                Strike,
                Code,
            ],
            content: this.modelValue,
            editable: !this.viewOnly,
            onUpdate: () => {
                // HTML
                this.$emit("update:modelValue", this.editor.getHTML());

                // JSON
                // this.$emit('update:modelValue', this.editor.getJSON())
            },
        });
    },

    beforeUnmount() {
        this.editor.destroy();
    },
};
</script>

<style lang="scss">
.tiptap {
    > * + * {
        margin-top: 0.75em;
    }

    ul,
    ol {
        padding: 0 1rem;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        line-height: 1.1;
    }

    code {
        background-color: rgba(#616161, 0.1);
        color: #616161;
    }

    pre {
        background: #0d0d0d;
        color: #fff;
        font-family: "JetBrainsMono", monospace;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;

        code {
            color: inherit;
            padding: 0;
            background: none;
            font-size: 0.8rem;
        }
    }

    img {
        max-width: 100%;
        height: auto;
    }

    blockquote {
        padding-left: 1rem;
        border-left: 2px solid rgba(#0d0d0d, 0.1);
    }

    hr {
        border: none;
        border-top: 2px solid rgba(#0d0d0d, 0.1);
        margin: 2rem 0;
    }
    button {
        margin: 0 4px;
        border: 1px solid black;
        padding: 8px;
    }
}
</style>
