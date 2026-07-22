# OpenSEO for super69

This repository is configured to use [OpenSEO](https://github.com/every-app/open-seo)
— an open-source alternative to Semrush/Ahrefs — through its **MCP server** and its
**Agent Skills**, so an AI agent (Claude Code, etc.) can run real SEO workflows here.

## What's set up

| Piece | Location | Purpose |
| ----- | -------- | ------- |
| OpenSEO MCP server | [`.mcp.json`](.mcp.json) | Gives the agent live SEO tools (keyword research, SERPs, rankings, backlinks, GSC) |
| OpenSEO Agent Skills | [`.claude/skills/`](.claude/skills/) | 7 reusable SEO workflows the agent can invoke |
| SEO work products | [`docs/seo/`](docs/seo/) | Audits and command playbooks (e.g. superrollforming.com) |

### MCP server

`.mcp.json` registers the hosted OpenSEO MCP endpoint:

```json
{
  "mcpServers": {
    "openseo": { "type": "http", "url": "https://app.openseo.so/mcp" }
  }
}
```

It exposes tools including `list_projects`, `research_keywords`, `get_keyword_metrics`,
`get_ranked_keywords`, `get_serp_results`, `search_local_businesses`,
`get_local_serp_results`, `get_google_business_questions`, `list_saved_keywords`,
`save_keywords`, and `get_search_console_performance`.

### Agent Skills (installed to `.claude/skills/`)

| Skill | What it does |
| ----- | ------------ |
| `seo-project-setup` | Create a durable local SEO workspace (context, goals, positioning, GSC intake) |
| `seo-coach` | Friendly coach mode — explains workflows and recommends next steps |
| `keyword-research` | Turn seed topics into a prioritized keyword opportunity set |
| `keyword-clustering` | Cluster keywords by intent and map them to pages |
| `competitor-analysis` | Analyze one competitor's organic footprint and gaps |
| `competitive-landscape` | Map market leaders, content themes, and strategic gaps |
| `link-prospecting` | Find link prospects and draft outreach |

## One-time authentication (required before running commands)

The OpenSEO MCP endpoint is **OAuth-protected** (`WWW-Authenticate: Bearer realm="OAuth"`).
The tools stay `⏸ Pending approval` until you log in with your OpenSEO account **once, in an
interactive terminal** — this cannot be done from a headless/CI session:

```bash
# from this repo directory, in your own terminal:
claude          # launch Claude Code; approve the openseo server + complete OpenSEO login in the browser
# then verify:
claude mcp list # openseo should show ✔ connected
```

You need an OpenSEO account (free trial at https://openseo.so) with a DataForSEO key
configured, or a self-hosted OpenSEO instance — the MCP pulls paid keyword/backlink data.

## Reproduce the setup from scratch

```bash
# 1. MCP server (project scope -> writes .mcp.json)
claude mcp add --transport http --scope project openseo https://app.openseo.so/mcp

# 2. Agent skills
npx skills add every-app/open-seo --skill '*' --agent claude-code
```

Docs: https://openseo.so/docs/mcp · https://openseo.so/docs/skills/setup
